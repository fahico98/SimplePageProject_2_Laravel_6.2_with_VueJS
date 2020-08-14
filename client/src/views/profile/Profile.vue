
<template>

   <v-container class="ma-0 pa-0">

         <left-bar class="grey lighten-4" :cardUserData="cardUserData"/>
         <right-bar class="grey lighten-4"/>

         <div class="mx-2">

            <posts v-if="inRoute('auth_home')" class="mx-1"/>

            <messages v-else-if="inRoute('messages')"/>

            <settings v-else-if="inRoute('settings')"/>

            <v-tabs grow v-else v-model="tab" background-color="transparent" color="blue lighten-1">

               <v-tab class="text-capitalize" v-ripple="false" v-for="tab of tabs" :key="tab.id" :to="tab.route" exact>
                  {{ tab.name }}
               </v-tab>

               <v-tab-item v-for="tab of tabs" :key="tab.id" :value="tab.route">
                  <router-view :key="$route.path"/>
               </v-tab-item>

            </v-tabs>


         </div>

   </v-container>

</template>

<script>

   import Posts from "../../components/profile/posts/Posts";
   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import Messages from "../../components/profile/messages/Messages";
   import Settings from "../../components/profile/settings/Settings";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            tab: null,
            username: "",
            tabs: [
               { id: 1, name: "Publicaciones", route: "publicaciones"},
               { id: 2, name: "Seguidores", route: "seguidores"},
               { id: 3, name: "Seguidos", route: "seguidos"},
               { id: 4, name: "Me gusta", route: "me_gusta"}
            ],
            cardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""},
            emptyCardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""}
         }
      },

      components: {
         RightBar,
         LeftBar,
         Posts,
         Messages,
         Settings
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      mounted(){
         this.init(this.$route.params.username);
      },

      beforeRouteUpdate(to, from, next){
         if(this.inRoute("profile")){
            if(from.params.username != to.params.username){
               this.posts = [];
               this.currentPage = 0;
               this.cardUserData = this.emptyCardUserData;
               this.init(to.params.username);
            }
            next();
         }
      },

      methods: {

         async init(username){

            this.username = username;
            let response;

            try{
               if(this.authenticated){
                  if(this.username === this.user.username){
                     this.cardUserData = this.user;
                  }else{
                     response = await axios.get("public_user_data/" + this.username);
                     this.cardUserData = response.data;
                  }
               }else{
                  response = await axios.get("public_user_data/" + this.username);
                  this.cardUserData = response.data;
               }
            }catch(error){
               console.log(error);
            }
         },

         inRoute(routeName){
            return this.$route.matched.some(route => route.name == routeName);
         }
      }
   }

</script>
