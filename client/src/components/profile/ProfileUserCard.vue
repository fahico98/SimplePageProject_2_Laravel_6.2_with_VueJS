
<template>

   <v-container class="mt-8 px-12">

      <v-row justify="center" align="center">
         <v-avatar size="250">
            <img :src="userImageUrl" :alt="userCompleteName">
         </v-avatar>
      </v-row>

      <v-row class="mt-6">
         <v-card-title class="my-0 py-0">
            <span class="black--text">{{ userCompleteName }}</span>
         </v-card-title>
         <v-card-title class="my-0 py-0">
            <span class="font-weight-light grey--text">{{ userUsername }}</span>
         </v-card-title>
      </v-row>

      <v-row class="mt-3">
         <v-card-subtitle class="my-0 py-0 blue--text text--lighten-1">
            <v-icon medium dense color="blue linghten-1">mdi-email-outline</v-icon>&nbsp;{{ userEmail }}
         </v-card-subtitle>
      </v-row>

      <v-row class="mt-6" v-if="profileOwner">
         <v-card-subtitle v-if="userBio" class="my-0 py-0 black--text">{{ userBio }}</v-card-subtitle>
         <v-card-subtitle v-else class="my-0 py-0"><a href="#">Agregar biografía</a></v-card-subtitle>
      </v-row>
      <v-row class="mt-6" v-else>
         <v-card-subtitle v-if="userBio" class="my-0 py-0 black--text">{{ userBio }}</v-card-subtitle>
      </v-row>

   </v-container>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      props: {
         publicUserData: {
            required: true
         }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         profileOwner(){
            return this.authenticated ? this.user.username === this.publicUserData.username : false;

         },

         userImageUrl(){
            return this.publicUserData ? axios.defaults.baseURL.replace("/api", "") + this.publicUserData.profile_picture : "";
         },

         userCompleteName(){
            return this.publicUserData ? this.publicUserData.name + ' ' + this.publicUserData.lastname : "";
         },

         userUsername(){
            return this.publicUserData ? this.publicUserData.username : "";
         },

         userEmail(){
            return this.publicUserData ? this.publicUserData.email : "";
         },

         userBio(){
            return this.publicUserData ? this.publicUserData.biography : "";
         }
      },

      methods: {

      }
   }
</script>
