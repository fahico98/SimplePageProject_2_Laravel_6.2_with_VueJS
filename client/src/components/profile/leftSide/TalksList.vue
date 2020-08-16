
<template>

   <v-container class="my-0 px-5">



      <v-list flat>


         <!-- <v-divider></v-divider> -->

         <v-list-item-group class="my-0">

            <div class="ma-0 pa-0" v-for="(talk, index) in talks" :key="index">

               <v-divider v-if="talk.divider"></v-divider>
               <!-- <v-skeleton-loader class="ma-0 pa-0" type="list-item-avatar-three-line"/> -->

               <v-list-item v-else class="px-2" style="cursor: pointer">

                  <v-container class="ma-0 pa-0" v-if="talk.skeleton">
                     <v-row class="ma-0 pa-0 my-2">
                        <v-col class="ma-0 pa-0" cols="3">
                           <v-skeleton-loader class="mx-auto" type="avatar"></v-skeleton-loader>
                        </v-col>
                        <v-col class="ma-0 pa-0 my-auto" cols="9">
                           <v-skeleton-loader class="mx-auto" type="sentences"></v-skeleton-loader>
                        </v-col>
                     </v-row>
                     <!-- <v-skeleton-loader class="ma-0 pa-0" width="100%" height="50%" type="list-item-avatar-two-line"
                        v-if="talk.skeleton"/> -->
                  </v-container>

                  <template v-else>

                     <v-list-item-avatar>
                        <v-img :src="correctedImageUrl(talk.recipient)"></v-img>
                     </v-list-item-avatar>

                     <v-list-item-content>
                        <v-list-item-title>
                           <span class="blue--text text--lighten-1">{{ completeName(talk.recipient) }}</span>
                        </v-list-item-title>
                        <v-list-item-subtitle>
                           <span>{{ talk.recipient.username }}</span>
                        </v-list-item-subtitle>
                     </v-list-item-content>

                  </template>

               </v-list-item>

            </div>

         </v-list-item-group>
      </v-list>
   </v-container>

</template>

<script>

   // import FollowedBrowser from "./FollowedBrowser";
   import axios from "axios";

   export default {

      data(){
         return {
            talks: []
         }
      },

      components: {
         // FollowedBrowser
      },

      methods: {

         skeleton(){
            if(this.talks.length){
               this.talks.unshift({ divider: true });
            }
            this.talks.unshift({ skeleton: true });
         },

         addTalk(talk){
            this.talks.splice(0, 1, talk);
         },

         completeName(user){
            return `${user.name} ${user.lastname}`;
         },

         correctedImageUrl(user){
            return user.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") + user.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         },
      }
   }

</script>
