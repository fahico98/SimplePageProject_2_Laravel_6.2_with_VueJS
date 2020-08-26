
<template>

   <v-container class="pa-0 ma-0 my-2">
      <v-row class="ma-0 pa-0">

         <v-col width="100%" cols="10" class="container-border blue lighten-4" v-if="mine">
            <div class="flex-grow-0 flex-shrink-1" width="100%" v-html="correctedContent"></div>
            <div class="ma-0 text-caption mt-3 blue--text text--lighten-1">{{ message.created_at_for_humans }}</div>
         </v-col>
         <v-col cols="1" offset="1" class="pr-0 pt-2 d-flex align-center" v-if="mine">
            <delete-talk-message action="message" @eventTriggered="deleteMessage(message.id)"/>
         </v-col>

         <v-col width="100%" cols="10" offset="2" class="container-border" v-if="!mine">
            <div class="flex-grow-0 flex-shrink-1" style="text-align:right" width="100%" v-html="correctedContent"></div>
            <div class="ma-0 text-caption mt-3 blue--text text--lighten-1" style="text-align:right">
               {{ message.created_at_for_humans }}
            </div>
         </v-col>

      </v-row>
   </v-container>

</template>

<script>

   import DeleteTalkMessage from "../modals/DeleteTalkMessage";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            snackbar: false
         }
      },

      components: {
         DeleteTalkMessage
      },

      props: {
         message: {
            type: Object,
            required: true
         }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         mine(){
            return this.message.sender_id == this.user.id;
         },

         correctedContent(){
            let senderName = this.mine ? "Yo" : this.message.sender.name;
            return "<p class='text-h6 font-weight-bold blue--text text--lighten-1 ma-0 pa-0 mb-3'>"
               + senderName + ".</p>" + this.message.content.replace(/\n/g, "<br>").trim();
         }
      },

      methods: {

         deleteMessage(id){

            axios.delete("messages/delete_message", { params: {message_id: id }})
               .catch((error) => {
                  console.log(error);
               });

            this.$emit("removeMessage", id);
         }
      }
   }

</script>

<style scoped>

   .container-border{
      border-style: solid;
      border-width: 1px;
      border-color: #C4C4C4;
      border-radius: 15px;
      background-color: white;
   }

</style>
