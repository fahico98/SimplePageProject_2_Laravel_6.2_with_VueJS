
<template>

   <v-app>

      <profile-side-bar class="grey lighten-4" v-if="inProfile()"></profile-side-bar>
      <auxiliar-side-bar class="grey lighten-4" v-if="inProfile()"></auxiliar-side-bar>

      <main-app-bar/>

      <v-main class="grey lighten-4">
         <v-container>
            <div>
               <router-view></router-view>
            </div>
         </v-container>
      </v-main>

      <main-footer v-if="!inProfile()"/>

   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";
   import MainFooter from "./components/MainFooter";
   import ProfileSideBar from "./components/profile/ProfileSideBar";
   import AuxiliarSideBar from "./components/profile/AuxiliarSideBar";
   import { mapGetters } from "vuex";

   export default {

      name: 'App',

      components: {
         MainAppBar,
         MainFooter,
         ProfileSideBar,
         AuxiliarSideBar
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
