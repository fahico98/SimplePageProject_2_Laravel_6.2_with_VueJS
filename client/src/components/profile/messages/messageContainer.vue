
<template>

   <v-container class="ma-0 pa-0 blue lighten-5" style="border-radius: 10px;">
      <v-row class="ma-0 pa-0">

         <v-col cols="11" v-if="mine">
            <p class="blue--text text--lighten-1 ma-0" style="white-space: pre;">{{ trimmedContent }}</p>
         </v-col>
         <v-col cols="1" v-if="mine">
            <v-btn color="blue lighten-1" icon text small>
               <v-icon small title="Eliminar mensaje">mdi-close</v-icon>
            </v-btn>
         </v-col>

         <v-col cols="11" v-if="!mine">
            {{ message.content }}
         </v-col>
         <v-col cols="1" v-if="!mine">

         </v-col>

      </v-row>
   </v-container>

</template>

<script>

   import { mapGetters } from "vuex";

   export default {

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

         trimmedContent(){
            return this.message.content.trim();
         }
      }
   }

</script>
