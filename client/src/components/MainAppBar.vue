
<template>

   <v-app-bar height="80" elevation="2" color="blue lighten-1" clipped-left clipped-right dark app>

      <div class="d-flex align-center">
         <v-img contain style="cursor: pointer" alt="Vuetify Logo" class="shrink ml-3" width="40px" @click.prevent="goToHome()"
            src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"/>
      </div>

      <v-spacer></v-spacer>

      <authenticated-app-bar-navigation v-if="authenticated"/>
      <main-app-bar-navigation v-else/>

   </v-app-bar>

</template>

<script>

   import MainAppBarNavigation from "./MainAppBarNavigation";
   import AuthenticatedAppBarNavigation from "./auth/AuthenticatedAppBarNavigation";
   import { mapGetters } from "vuex";

   export default {

      components: {
         MainAppBarNavigation,
         AuthenticatedAppBarNavigation
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      methods: {
         goToHome(){
            let routeName = this.authenticated ? "auth_home" : "home";
            this.$router.push({name: routeName});
         }
      }
   }

</script>
