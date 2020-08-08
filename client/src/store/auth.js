
import axios from "axios";

export default {

   namespaced: true,

   state: {
      token: null,
      user: null
   },

   getters: {

      authenticated(state){
         return state.token && state.user;
      },

      user(state){
         return state.user;
      }
   },

   mutations: {

      SET_TOKEN(state, token){
         state.token = token;
      },

      SET_USER(state, user){
         state.user = user;
      },

      SET_PROFILE_PICTURE(state, profile_picture){
         if(state.user){ state.user.profile_picture = profile_picture; }
      },

      SET_BIO(state, bio){
         if(state.user){ state.user.biography = bio; }
      }
   },

   actions: {

      setProfilePicture({ commit }, profile_picture){
         commit("SET_PROFILE_PICTURE", profile_picture);
      },

      setBio({ commit }, bio){
         commit("SET_BIO", bio);
      },

      async loginAction({ dispatch }, credentials){
         let response = await axios.post("auth/login", credentials);
         return dispatch("meAction", response.data.access_token);
      },

      async meAction({ commit, state }, token){

         if(token){ commit("SET_TOKEN", token); }
         if(!state.token){ return; }

         try{
            // Cuando se deban agregar headers a la solicitud es mejor no usar alias (axios.post).
            let response = await axios.get("auth/me");

            // if(response.data.profile_picture){
            //    response.data.profile_picture.url = axios.defaults.baseURL.replace("/api", "") +
            //       response.data.profile_picture.url.replace("public/", "storage/");
            // }else{
            //    response.data.profile_picture = {
            //       url: axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg",
            //       size: 5229
            //    };
            // }

            commit("SET_USER", response.data);
         }catch(error){
            commit("SET_TOKEN", null);
            commit("SET_USER", null);
         }
      },

      async registerAction(context, registerData){
         return await axios.post("auth/register", registerData);
      },

      logoutAction({ commit }){
         return axios.get("auth/logout")
            .then(() => {
               commit("SET_TOKEN", null);
               commit("SET_USER", null);
            });
      }
   },

   modules: {
      //
   }
};
