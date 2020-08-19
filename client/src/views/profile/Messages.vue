
<template>

   <v-container class="ma-0 pa-0 grey lighten-4">

      <left-bar class="grey lighten-4" @selectedTalk="catchSelectedTalk($event)"/>
      <right-bar class="grey lighten-4"/>

      <div class="mx-2">

         <v-container class="ma-0 pa-0" width="100%">

            <!-- <v-row>
               <v-col cols="12">
                  <send-message-modal-form v-if="selectedTalk.id != 0" :talk="selectedTalk"
                     @sendedMessage="addMessage($event)"/>
                  <v-divider class="mt-2" v-if="selectedTalk.id != 0"></v-divider>
               </v-col>
            </v-row> -->

            <infinite-loading v-if="selectedTalk.id != 0" class="align-self-end" @infinite="loadMessages">
               <template v-slot:no-more>
                  <p class="blue--text text--lighten-1 pb-2 pt-6">No hay mas mensajes !</p>
               </template>
               <template v-slot:no-results>
                  <p class="blue--text text--lighten-1 py-5">Aún no hay mensajes !</p>
               </template>
            </infinite-loading>


            <div class="ma-0 pa-0" v-for="(message, index) in messages" :key="index">
               <message-container :message="message"/>
               <v-row class="my-2 pa-0">
                  <v-divider></v-divider>
               </v-row>
            </div>

            <div class="ma-0 pa-0 mt-2">
               <send-message-modal-form v-if="selectedTalk.id != 0" :talk="selectedTalk" @sendedMessage="addMessage($event)"/>
               <!-- <v-row class="my-2 pa-0">
                  <v-divider class="mt-0" v-if="selectedTalk.id != 0"></v-divider>
               </v-row> -->
            </div>

         </v-container>
      </div>
   </v-container>

</template>

<script>

   import axios from "axios";
   import { mapGetters } from "vuex";
   import InfiniteLoading from 'vue-infinite-loading';
   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import MessageContainer from "../../components/profile/messages/messageContainer";
   import SendMessageModalForm from "../../components/profile/modals/SendMessageModalForm";

   export default {

      data(){
         return {
            messages: [],
            currentPage: 0,
            selectedTalk: {
               id: 0
            }
         }
      },

      components: {
         SendMessageModalForm,
         InfiniteLoading,
         MessageContainer,
         RightBar,
         LeftBar
      },

      watch: {
         selectedTalk(){
            this.currentPage = 0;
            this.messages = [];
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      methods: {

         loadMessages($state){

            if(this.selectedTalk.id){

               this.currentPage++;

               axios.get(`messages/index/${this.selectedTalk.id}/${this.currentPage}`)
                  .then((response) => {
                     if(response.data.length){

                        this.messages = this.messages.concat(response.data);
                        $state.loaded();

                        if(response.data.length < 20){
                           $state.complete();
                        }

                     }else{
                        $state.complete();
                     }
                  })
                  .catch((error) => {
                     console.log(error)
                  });
            }else{
               $state.complete();
            }
         },

         addMessage(message){
            this.messages.unshift(message);
         },

         catchSelectedTalk(talk){
            this.selectedTalk = talk;
         }
      }
   }

</script>
