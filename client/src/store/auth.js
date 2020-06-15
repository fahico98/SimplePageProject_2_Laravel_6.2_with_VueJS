
import axios from "axios";

export default {

   namespaced: true,

   state: {
      token: null,
      user: null
   },

   mutations: {

      SET_TOKEN(state, token){
         state.token = token;
      },

      SET_USER(state, user){
         state.user = user;
      }
   },

   actions: {

      async loginAction({ dispatch }, credentials){
         let response = await axios.post("auth/login", credentials);
         dispatch("attemptAction", response.data.access_token);
      },

      async attemptAction({ commit }, token){
         commit("SET_TOKEN", token);
         try{

            // Cuando se deban agregar headers a la solicitud es mejor no usar alias (axios.post).
            let response = await axios({
               method: "post",
               url: "auth/me",
               headers: {
                  "Authorization": "Bearer " + token
               }
            });
            console.log(response.data);
            commit("SET_USER", response.data);
         }catch(error){
            commit("SET_TOKEN", null);
            commit("SET_USER", null);
         }
      }
   },

   modules: {
      //
   }
};
