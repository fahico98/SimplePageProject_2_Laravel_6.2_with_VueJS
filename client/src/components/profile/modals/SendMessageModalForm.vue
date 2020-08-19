
<template>

   <div v-if="talk.id != 0" style="display: inline">
      <v-dialog v-model="dialog" width="600px" height="500px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn text depressed class="mx-0 text-capitalize" color="blue lighten-1" v-ripple="false"
               width="100%" v-bind="attrs" v-on="on">
               <v-icon>mdi-email-plus-outline</v-icon><span class="ml-2">Nuevo mensajes</span>
            </v-btn>
         </template>

         <v-card :loading="loading">

            <v-card-title class="headline pt-5">Nuevo mensaje</v-card-title>

            <v-form class="mt-5 pa-0" @submit.prevent="">

               <v-textarea no-resize outlined v-model="message" color="blue lighten-1" rows="4" class="px-5" label="Mensaje"
                  @input="$v.message.$touch()" :error-messages="messageErrors"/>

               <v-card-actions>

                  <v-btn depressed dark @click="send()" type="submit" class="mb-2 ml-3 text-capitalize" v-ripple="false"
                     color="blue lighten-1">Enviar
                  </v-btn>

                  <v-btn depressed text light v-ripple="false" class="mb-2 ml-3 text-capitalize" color="blue lighten-1"
                     @click="dialog = false">cancelar
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>
      </v-dialog>
   </div>

</template>

<script>

   import { maxLength, required } from "vuelidate/lib/validators";
   import axios from "axios";

   export default {

      data(){
         return {
            loading: false,
            dialog: false,
            message: ""
         }
      },

      validations: {
         message: { required, maxLength: maxLength(65000) }
      },

      props: {
         talk: {
            type: Object,
            required: true
         }
      },

      computed: {

         messageErrors(){
            const errors = [];
            if(!this.$v.message.$dirty){ return errors; }
            !this.$v.message.maxLength && errors.push('El mensaje que intenta enviar es demasiado largo.');
            !this.$v.message.required && errors.push('No puede enviar un mensaje vacío.');
            return errors;
         }
      },

      methods: {

         send(){
            if(!this.loading){
               this.$v.$touch();
               if(!this.$v.$invalid){
                  this.loading = "blue lighten-1";
                  axios.post("messages/send", {
                        content: this.message,
                        recipient_id: this.talk.recipient.id
                     })
                     .then((response) => {
                        if(response.data){
                           this.$emit("sendedMessage", response.data);
                           this.loading = false;
                        }
                     })
                     .catch((error) => {
                        console.log(error);
                     })
               }
            }
         }
      }
   }

</script>
