
<template>

   <v-container class="ma-0 pa-0">

      <left-bar class="grey lighten-4" @selectedTalk="catchSelectedTalk($event)"/>
      <right-bar class="grey lighten-4"/>

      <div>
         <v-container class="ma-0 pa-0" width="100%">

            <infinite-loading v-if="selectedTalk.id != 0" class="align-self-end" @infinite="loadMessages">
               <template v-slot:no-more>
                  <p class="blue--text text--lighten-1 pb-2 pt-6">No hay mas mensajes !</p>
               </template>
               <template v-slot:no-results>
                  <p class="blue--text text--lighten-1 py-5">Aún no hay mensajes !</p>
               </template>
            </infinite-loading>


            <div class="ma-0 pa-0" v-for="(message, index) in messages" :key="index">
               <!-- <v-row class="ma-0 pa-0">
                  <v-divider></v-divider>
               </v-row> -->
               <message-container :message="message"/>
            </div>

            <div class="ma-0 pa-0 mb-4">
               <v-row class="mb-2 pa-0">
                  <v-divider class="mt-0" v-if="selectedTalk.id != 0"></v-divider>
               </v-row>
               <send-message-modal-form v-if="selectedTalk.id != 0" :talk="selectedTalk" @sendedMessage="addMessage($event)"/>
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
            this.messages.push(message);
         },

         catchSelectedTalk(talk){
            this.selectedTalk = talk;
         }
      }
   }

</script>
