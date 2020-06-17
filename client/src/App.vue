
<template>

   <v-app>

      <profile-side-bar v-if="inProfile()"></profile-side-bar>

      <main-app-bar/>

      <v-main>
         <v-container>
            <router-view></router-view>
         </v-container>
      </v-main>

      <main-footer v-if="!inProfile()"/>

   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";
   import MainFooter from "./components/MainFooter";
   import ProfileSideBar from "./components/profile/ProfileSideBar";
   import { mapGetters } from "vuex";

   export default {

      name: 'App',

      components: {
         MainAppBar,
         MainFooter,
         ProfileSideBar
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated"
         })
      },

      data(){
         return {

         }
      },

      methods: {
         inProfile(){
            return this.$route.name == "profile";
         }
      }
   };

</script>
