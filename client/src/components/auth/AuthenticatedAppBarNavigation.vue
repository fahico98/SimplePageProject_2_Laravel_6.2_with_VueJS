
<template>

   <div>
      <v-menu :close-on-click="true" :close-on-content-click="true" :offset-y="true">

         <template v-slot:activator="{ on, attrs }">
            <v-btn color="white" class="mr-5" v-bind="attrs" v-on="on" :ripple="false" icon x-small>
               <v-avatar size="40">
                  <img :src="userImageUrl()" :alt="user.username">
               </v-avatar>
            </v-btn>
         </template>

         <v-list dense>
            <v-list-item justify="center" :ripple="false" v-on:click="goToProfile(user.username)">
               <v-list-item-title class="body-2 font-weight-bold">{{ user.username }}</v-list-item-title>
            </v-list-item>
            <v-list-item :ripple="false" v-on:click="goTo('settings')">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">configuración</v-list-item-title>
            </v-list-item>
            <v-list-item :ripple="false" v-on:click="logout()">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">cerrar sesión</v-list-item-title>
            </v-list-item>
         </v-list>

      </v-menu>
   </div>

</template>

<script>

   import { mapActions, mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            //
         }
      },

      computed: {
         ...mapGetters({
            user: "auth/user"
         })
      },

      methods: {

         ...mapActions({
            logoutAction: "auth/logoutAction"
         }),

         logout(){
            this.logoutAction()
               .then(() => {
                  this.$router.push({name: "login"});
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         goToProfile(username){
            this.$router.push({name: "profile", params: {username: username}});
         },

         userImageUrl(){
            return axios.defaults.baseURL.replace("/api", "") + this.user.profile_picture;
         },

         goTo(routeName){
            console.log("--> " + routeName);
            //this.$router.push({name: routeName});
         }
      }
   }

</script>
