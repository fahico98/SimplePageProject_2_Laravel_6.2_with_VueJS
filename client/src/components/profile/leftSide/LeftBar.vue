
<template>

   <v-navigation-drawer width="25%" permanent clipped app light>

      <!----------------------------------------- Profile ----------------------------------------->

      <user-data-card v-if="inRoute('profile')" :cardUserData="cardUserData"/>

      <!----------------------------------------- Messages ----------------------------------------->

      <talks-list v-if="inRoute('messages')" :talk="talk" @talkAdded="talkAdded()"/>

      <template v-if="inRoute('messages')" v-slot:prepend>
         <followed-browser @newTalk="addTalk($event)"/>
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

      data(){
         return {

            //----------------------------------------- Messages -----------------------------------------

            talk: {},

            //--------------------------------------------------------------------------------------------
         }
      },

      components: {
         FollowedBrowser,
         UserDataCard,
         TalksList
      },

      props: {
         cardUserData: {
            type: Object,
            required: false
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),
      },

      methods: {

         inRoute(routeName){
            return this.$route.matched.some(route => route.name == routeName);
         },

         //------------------------------------------- Messages ------------------------------------------

         addTalk(talk){
            this.talk = talk;
         },

         talkAdded(){
            this.talk = {};
         }

         //-----------------------------------------------------------------------------------------------
      }
   }

</script>
