
<template>

   <v-dialog v-model="dialog" width="450px">

      <template v-slot:activator="{ on, attrs }">

         <v-btn small dark depressed v-if="action == 'store'" v-ripple="false" color="blue lighten-1" width="100%"
            class="text-capitalize" v-bind="attrs" v-on="on">agregar biografia</v-btn>

         <v-btn small icon class="ml-2" v-else-if="action == 'edit'" v-ripple="false" v-bind="attrs" v-on="on">
            <v-icon small dense color="blue lighten-1">mdi-pencil-outline</v-icon>
         </v-btn>

      </template>

      <v-card :loading="loading">
         <v-form class="ma-0 pa-0" @submit.prevent="">

            <v-textarea no-resize outlined v-model="bio" counter="120" color="blue lighten-1" rows="5" class="pt-7 px-5"
               label="Biografía" @input="$v.bio.$touch()" :error-messages="bioErrors"/>

            <v-card-actions>
               <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                  <span class="px-2">Guardar</span>
               </v-btn>
            </v-card-actions>

         </v-form>
      </v-card>

   </v-dialog>

</template>

<script>

   import axios from "axios";
   import { validationMixin } from "vuelidate";
   import { helpers, maxLength, required } from "vuelidate/lib/validators";

   const alphaNum = helpers.regex("alphaNum", /^[ -_\nñÑ.,;:()áéíóúa-zA-Z0-9]*$/);

   export default {

      mixins: [validationMixin],

      data(){
         return {
            dialog: false,
            loading: false,
            bio: ""
         }
      },

      props: {

         action: {
            required: true,
            type: String
         },

         bioProp: {
            required: false,
            type: String
         }
      },

      validations: {
         bio: {alphaNum, required, maxLength: maxLength(120)}
      },

      computed: {
         bioErrors(){
            const errors = [];
            if(!this.$v.bio.$dirty){ return errors; }
            !this.$v.bio.maxLength && errors.push('Máximo 120 caracteres.');
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
            }else{
               if(this.action == "edit"){
                  this.bio = this.bioProp;
               }
            }
         }
      },

      methods: {
         submit(){
            this.$v.$touch();
            if(!this.$v.$invalid){
               this.loading = "blue lighten-1";
               axios.post("store_bio", {bio: this.bio})
                  .then((response) => {
                     if(response.data){
                        this.$emit("bioChangedSuccessfully", this.bio);
                        this.bio = "";
                        this.loading = false;
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
