
<template>

   <v-row justify="center">
      <v-dialog v-model="dialog" width="450px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn small dark depressed color="blue lighten-1" width="100%" class="text-capitalize" v-bind="attrs"
               v-on="on">agregar biografia</v-btn>
         </template>

         <v-card>
            <v-form class="ma-0 pa-0" @submit.prevent="">
               <v-textarea no-resize outlined v-model="bio" counter="200" color="blue lighten-1" rows="5" class="pt-5 px-5"
                  label="Biografía" @input="$v.bio.$touch()" @blur="$v.bio.$touch()" :error-messages="bioErrors"/>
               <v-card-actions>
                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                     <span class="px-2">Guardar</span>
                  </v-btn>
               </v-card-actions>
            </v-form>
         </v-card>

      </v-dialog>
  </v-row>

</template>

<script>

   import axios from "axios";
   import { validationMixin } from "vuelidate";
   import { helpers, maxLength, required } from "vuelidate/lib/validators";

   const alphaNum = helpers.regex("alphaNum", /^[ ñÑ.a-zA-Z0-9]*$/)

   export default {

      mixins: [validationMixin],

      data(){
         return {
            dialog: false,
            bio: ""
         }
      },

      validations: {
         bio: {alphaNum, required, maxLength: maxLength(200)}
      },

      computed: {
         bioErrors(){
            const errors = [];
            if(!this.$v.bio.$dirty){ return errors; }
            !this.$v.bio.maxLength && errors.push('Máximo 200 caracteres.');
            !this.$v.bio.alphaNum && errors.push('No se admite caracteres especiales.');
            !this.$v.bio.required && errors.push('La biografía no puede estar vacía.');
            return errors;
         },
      },

      watch: {
         dialog(dialog){
            if(!dialog){
               this.bio = "";
               this.$v.$reset();
            }
         }
      },

      methods: {
         submit(){
            this.$v.$touch();
            if(!this.$v.$invalid){
               axios.post("store_bio", {bio: this.bio})
                  .then((response) => {
                     if(response.data){
                        this.$emit("bioChangedSuccessfully", this.bio);
                        this.bio = "";
                        this.dialog = false;
                     }
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         }
      }
   }

</script>
