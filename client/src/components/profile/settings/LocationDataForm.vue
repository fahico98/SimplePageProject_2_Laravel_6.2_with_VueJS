
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.country" label="País" class="ma-0 pa-0 mt-1"
               @input="$v.form.country.$touch()" @blur="$v.form.country.$touch()" :error-messages="countryErrors" outlined
               dense></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.city" label="Ciudad" class="ma-0 pa-0 mt-1"
               @input="$v.form.city.$touch()" @blur="$v.form.city.$touch()" :error-messages="cityErrors" outlined dense>
               </v-text-field>

         </v-col>

      </v-row>

      <v-row class="ma-0 pa-0 mt-5">

         <v-btn dark depressed class="text-capitalize" color="blue lighten-1" @click.prevent="submit()">
            guardar cambios</v-btn>
         <v-btn dark outlined class="text-capitalize ml-2" color="blue lighten-1">
            restaurar</v-btn>

      </v-row>

   </v-container>

</template>

<script>

   import { validationMixin } from "vuelidate";
   import { helpers, maxLength } from "vuelidate/lib/validators";

   const alpha = helpers.regex("alpha", /^[ ñÑ.a-zA-Z]*$/);

   export default {

      mixins: [validationMixin],

      data(){
         return {
            form: {
               country: "",
               city: ""
            }
         }
      },

      validations: {
         form: {
            country: {alpha, maxLength: maxLength(35)},
            city: {alpha, maxLength: maxLength(35)}
         }
      },

      computed: {

         countryErrors(){
            const errors = [];
            if(!this.$v.form.country.$dirty){ return errors; }
            !this.$v.form.country.maxLength && errors.push('El país no debe tener mas de 35 caracteres.');
            !this.$v.form.country.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            return errors;
         },

         cityErrors(){
            const errors = [];
            if(!this.$v.form.city.$dirty){ return errors; }
            !this.$v.form.city.maxLength && errors.push('La ciudad no debe tener mas de 35 caracteres.');
            !this.$v.form.city.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            return errors;
         }
      },

      methods: {

         submit(){
            console.log("LocationDataForm.vue component submited...!");
         }
      }
   }

</script>
