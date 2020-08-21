
<template>

   <v-container class="ma-0 py-0 px-5">

      <v-divider></v-divider>

      <v-list flat class="py-0 my-0">
         <v-list-item-group class="my-0 py-0">

            <div class="ma-0 pa-0" v-for="(talk, index) in talks" :key="index">

               <v-divider v-if="talk.divider"></v-divider>

               <v-list-item v-else class="px-2" style="cursor: pointer" @click.prevent="selectedTalk(talk)">

                  <v-container class="ma-0 pa-0" v-if="talk.skeleton">
                     <v-row class="ma-0 pa-0 my-2">
                        <v-col class="ma-0 pa-0" cols="3">
                           <v-skeleton-loader class="mx-auto" type="avatar"></v-skeleton-loader>
                        </v-col>
                        <v-col class="ma-0 pa-0 my-auto" cols="9">
                           <v-skeleton-loader class="mx-auto" type="sentences"></v-skeleton-loader>
                        </v-col>
                     </v-row>
                  </v-container>

                  <template v-else>

                     <v-list-item-avatar>
                        <v-img :src="correctedImageUrl(talk)"></v-img>
                     </v-list-item-avatar>

                     <v-list-item-content>
                        <v-list-item-title>
                           <span class="blue--text text--lighten-1">{{ completeName(talk) }}</span>
                        </v-list-item-title>
                        <v-list-item-subtitle>
                           <span>
                              {{ talk.recipient.id == user.id ? talk.sender.username : talk.recipient.username }}
                           </span>
                        </v-list-item-subtitle>
                     </v-list-item-content>

                  </template>

               </v-list-item>
            </div>

            <infinite-loading ref="infiniteLoading" @infinite="loadTalks">
               <template v-slot:no-more>
                  <p class="blue--text text--lighten-1 my-2 body-2">...</p>
               </template>
               <template v-slot:no-results>
                  <p :class="'blue--text text--lighten-1 body-2 ' + marginClass">{{ noResultsMessage }}</p>
               </template>
            </infinite-loading>

         </v-list-item-group>
      </v-list>
   </v-container>

</template>

<script>

   import InfiniteLoading from 'vue-infinite-loading';
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      components: {
         InfiniteLoading
      },

      data(){
         return {
            talks: [],
            currentPage: 0,
            noResultsMessage: "Aún no tienes conversaciones !",
            marginClass: "mt-5"
         }
      },

      props: {
         talk: {
            type: Object,
            default: null,
            required: true
         },
         skeleton: {
            type: Boolean,
            required: true
         }
      },

      watch: {
         talk(val){
            if(val){
               let buffer = new Object();
               let talk = new Object();
               buffer.data = val;
               talk = buffer.data;
               this.talks.splice(0, 1, talk);
               this.$emit("talkAdded");
            }
         },

         skeleton(val){
            if(val){
               if(this.marginClass == "mt-5"){
                  this.noResultsMessage = "...";
                  this.marginClass = "mt-2";
               }
               if(this.talks.length){
                  this.talks.unshift({ divider: true });
               }
               this.talks.unshift({ skeleton: true });
            }
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),
      },

      methods: {

         loadTalks($state){
            this.currentPage++;
            axios.get(`messages/talks/${this.currentPage}`)
               .then((response) => {
                  if(response.data){
                     if(response.data.length){
                        for(var i = 0; i < response.data.length; i++){
                           if(this.talks.length){
                              this.talks.unshift({ divider: true });
                           }
                           this.talks.unshift(response.data[i]);
                        }
                        $state.loaded();
                        if(response.data.length < 20){
                           $state.complete();
                        }
                     }else{
                        $state.complete();
                     }
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         completeName(talk){
            let user = talk.recipient.id == this.user.id ? talk.sender : talk.recipient;
            return `${user.name} ${user.lastname}`;
         },

         correctedImageUrl(talk){
            let user = talk.recipient.id == this.user.id ? talk.sender : talk.recipient;
            return user.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") + user.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         },

         selectedTalk(talk){
            this.$emit("selectedTalk", talk);
         }
      }
   }

</script>
