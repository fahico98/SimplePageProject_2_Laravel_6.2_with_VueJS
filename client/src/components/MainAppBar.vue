
<template>

   <div>
      <v-app-bar flat dark height="80" color="blue lighten-1">

         <div class="d-flex align-center">
            <v-img contain alt="Vuetify Logo" class="shrink ml-3" transition="scale-transition" width="40"
               src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"/>
         </div>

         <v-spacer></v-spacer>

         <div v-if="authenticated">
            <authenticated-app-bar-navigation/>
         </div><div v-else>
            <main-app-bar-navigation/>
         </div>

      </v-app-bar>
   </div>

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
