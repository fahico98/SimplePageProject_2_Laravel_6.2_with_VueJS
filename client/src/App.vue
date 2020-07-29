
<template>

   <v-app>

      <profile-left-bar class="grey lighten-4" v-if="inProfile()" v-bind:publicUserData="publicUserData"/>
      <profile-right-bar class="grey lighten-4" v-if="inProfile()"/>

      <main-app-bar/>

      <v-main class="grey lighten-4">
         <v-container>
            <div><router-view/></div>
         </v-container>
      </v-main>

      <main-footer v-if="!inProfile()"/>

   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";
   import MainFooter from "./components/MainFooter";
   import ProfileLeftBar from "./components/profile/ProfileLeftBar";
   import ProfileRightBar from "./components/profile/ProfileRightBar";
   import { mapGetters } from "vuex";

   export default {

      name: 'App',

      components: {
         MainAppBar,
         MainFooter,
         ProfileLeftBar,
         ProfileRightBar
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated"
         })
      },

      data(){
         return {
            publicUserData: null
         }
      },

      methods: {

         inProfile(){
            return this.$route.name == "profile";
         }
      }
   };

</script>
