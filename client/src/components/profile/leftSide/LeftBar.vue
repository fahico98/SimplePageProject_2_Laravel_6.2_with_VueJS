
<template>

   <v-navigation-drawer width="25%" permanent clipped app light>

      <!----------------------------------------- Profile ----------------------------------------->

      <user-data-card v-if="$route.matched.some(route => route.name == 'profile')" :cardUserData="cardUserData"/>

      <!----------------------------------------- Messages ----------------------------------------->

      <talks-list v-if="$route.matched.some(route => route.name == 'messages')"/>

      <template v-slot:prepend v-if="$route.matched.some(route => route.name == 'messages')">
         <followed-browser @newTalk="addTalk($event)" @skeleton="skeleton()"/>
      </template>

      <!----------------------------------------- Auth home ----------------------------------------->

      <!-- <outstanding-posts v-else-if="$route.name == 'auth_home'"/> -->
   </v-navigation-drawer>

</template>

<script>

   import FollowedBrowser from "./FollowedBrowser";
   import UserDataCard from "./UserDataCard";
   import TalksList from "./TalksList";
   import { mapGetters } from "vuex";

   export default {

      components: {
         FollowedBrowser,
         UserDataCard,
         TalksList
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
