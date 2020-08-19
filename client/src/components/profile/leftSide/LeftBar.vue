
<template>

   <v-navigation-drawer width="25%" permanent clipped app light>

      <!----------------------------------------- Profile ----------------------------------------->

      <user-data-card v-if="inRoute('profile')" :cardUserData="cardUserData"/>

      <!----------------------------------------- Messages ----------------------------------------->

      <talks-list v-if="inRoute('messages')" :talk="talk" :skeleton="skeleton" @talkAdded="skeleton = false"
         @selectedTalk="selectedTalk($event)"/>

      <template v-if="inRoute('messages')" height="100px" v-slot:prepend>
         <followed-browser @newTalk="addTalk($event)" @skeleton="skeleton = true"/>
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
            skeleton: false

            //--------------------------------------------------------------------------------------------
         }
      },

      components: {
         FollowedBrowser,
         UserDataCard,
         TalksList
      },

      props: {

         //----------------------------------------- Profile ------------------------------------------

         cardUserData: {
            type: Object,
            required: false
         }

         //--------------------------------------------------------------------------------------------

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

         selectedTalk(talk){
            this.$emit("selectedTalk", talk);
         }

         //-----------------------------------------------------------------------------------------------
      }
   }

</script>
