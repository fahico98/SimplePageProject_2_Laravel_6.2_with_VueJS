
<template>

   <v-container class="my-0 px-5">
      <v-list flat dense>

         <followed-browser/>

         <v-divider></v-divider>

         <!-- <v-list-item-group class="my-3">
            <v-list-item class="mx-0 px-0" :ripple="false" v-for="element in elements" :key="element.name">

               <v-btn @click.prevent="element.route == 'logout' ? logout() : goToRoute(element.route)" depressed text
                  :ripple="false" color="blue lighten-1" width="100%">
                  <p class="pa-0 ma-0 mr-auto" width="100%">
                     <v-icon left class="mr-4">{{ element.icon }}</v-icon>
                     <span class="subtitle-2 text-capitalize">{{ element.name }}</span>
                  </p>
               </v-btn>

            </v-list-item>
         </v-list-item-group> -->

      </v-list>
   </v-container>

</template>

<script>

   import FollowedBrowser from "./FollowedBrowser";

   export default {

      data(){
         return {

         }
      },

      components: {
         FollowedBrowser
      },

      methods: {

      }
   }

</script>
