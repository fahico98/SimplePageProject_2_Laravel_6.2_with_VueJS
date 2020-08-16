
<template>

   <div>
      <!-- <v-app> -->



         <!-- <v-footer class="grey lighten-4" style="width: 50%; margin-left: 25%;" height="90" padless fixed app>
            <v-container fluid>

               <v-form @submit.prevent="">
                  <v-row class="ma-0 pa-0">

                     <v-col class="ma-0 pa-0" cols="11">
                        <v-textarea no-resize dense outlined v-model="message" rows="2" width="100%" color="blue lighten-1"
                           background-color="white" @input="$v.message.$touch()" :error-messages="messageErrors"/>
                     </v-col>

                     <v-col class="ma-0 pa-0" cols="1">
                        <v-btn type="submit" fab depressed dark small color="blue lighten-1 ml-3"
                           @click.prevent="sendMessage()">
                           <v-icon dark>mdi-send</v-icon>
                        </v-btn>
                     </v-col>

                  </v-row>
               </v-form>

            </v-container>
         </v-footer> -->

         <v-container class="ma-0 pa-0 grey lighten-4" style="margin-top: 160px;">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
            explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
            laudantium at, deserunt adipisci delectus quo!
         </v-container>

         <v-snackbar v-model="snackbar" :timeout="5000" color="blue lighten-1">
            {{ snackbarText }}
            <template v-slot:action="{ attrs }">
               <v-btn text v-ripple="false" class="white--text text-capitalize" v-bind="attrs" @click="snackbar = false">
                  Ok
               </v-btn>
            </template>
         </v-snackbar>

      <!-- </v-app> -->
   </div>

</template>

<script>

   import axios from "axios";
   import { mapGetters } from "vuex";
   import { maxLength } from "vuelidate/lib/validators";

   export default {

      data(){
         return {
            talks: [],
            message: "",
            snackbar: false,
            snackbarText: "Máximo 120 caracteres para cada mensaje."
         }
      },

      validations: {
         message: { maxLength: maxLength(120) }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         messageErrors(){
            const errors = [];
            if(!this.$v.message.$dirty){ return errors; }
            !this.$v.message.maxLength && errors.push('');
            return errors;
         },
      },

      mounted(){
         axios.get("messages/index").
            then((response) => {
               if(response.data){
                  this.talks = response.data;
               }
            })
            .catch((error) => {
               console.log(error);
            });
      },

      methods: {

         sendMessage(){
            if(this.message.length > 0 && this.validateMessage()){
               axios.post(); // TO DO !
            }
         },

         validateMessage(){
            if(this.message.length > 120){
               this.snackbar = true;
               return false;
            }
            return true;
         }
      }
   }

</script>
