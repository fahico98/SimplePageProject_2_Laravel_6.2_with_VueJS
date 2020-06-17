
<template>

   <v-app-bar height="80" color="blue lighten-1" :clipped-left="true" flat dark app>

      <div class="d-flex align-center">
         <v-img contain alt="Vuetify Logo" class="shrink ml-3" width="40px" @click.prevent="$router.push({name: 'home'});"
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
      }
   }

</script>
