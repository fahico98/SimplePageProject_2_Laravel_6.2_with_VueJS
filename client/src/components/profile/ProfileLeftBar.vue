
<template>

   <!-- <v-navigation-drawer :floating="!inProfile()" width="25%" right permanent clipped app light> -->
   <v-navigation-drawer width="25%" permanent clipped app light>
      <profile-user-card v-if="$route.name == 'profile'" :cardUserData="cardUserData"/>
      <!-- <outstanding-posts v-else-if="$route.name == 'auth_home'"/> -->
   </v-navigation-drawer>

   <!--
   <nav class="v-navigation-drawer v-navigation-drawer--clipped v-navigation-drawer--fixed v-navigation-drawer--open theme--light"
   style="height: 100vh; top: 64px; transform: translateX(0%); width: 300px; max-height: calc(100% - 64px);"
   data-booted="true">
   -->

   <!--
   <nav class="v-navigation-drawer v-navigation-drawer--clipped v-navigation-drawer--fixed v-navigation-drawer--open theme--light"
   style="height: 100vh; top: 80px; max-height: calc(100% - 293px); transform: translateX(0%); width: 256px;"
   data-booted="true">
   -->

</template>

<script>

   import ProfileUserCard from "./ProfileUserCard";
   import { mapGetters } from "vuex";

   export default {

      components: {
         ProfileUserCard
      },

      props: {
         cardUserData: {
            type: Object
         }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),
      }
   }

</script>
