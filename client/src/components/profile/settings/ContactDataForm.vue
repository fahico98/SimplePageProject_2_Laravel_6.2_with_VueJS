
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.email" class="ma-0 pa-0 mt-1" label="Correo electrónico"
               @input="$v.form.email.$reset()" @blur="$v.form.email.$touch()" :error-messages="emailErrors"
               :loading="emailFieldLoading" outlined dense required></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.phone_number" class="ma-0 pa-0 mt-1" label="Número telefónico"
               @input="$v.form.phone_number.$touch()" @blur="$v.form.phone_number.$touch()" :error-messages="phoneNumberErrors"
               type="number" outlined dense></v-text-field>

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

   import axios from "axios";
   import { validationMixin } from "vuelidate";
   import { maxLength, email, required, numeric } from "vuelidate/lib/validators";

   export default {

      mixins: [validationMixin],

      data(){
         return {

            form: {
               email: "",
               phoneNumber: ""
            },

            emailFieldLoading: false
         }
      },

      validations: {
         form: {
            phone_number: {numeric, maxLength: maxLength(35)},
            email: {
               email,
               required,
               maxLength: maxLength(35),
               isUnique(value){
                  if (value === ''){ return true; }
                  this.emailFieldLoading = true;
                  return this.unique("auth/email_exists/" + value);
               }
            }
         }
      },

      computed: {

         phoneNumberErrors(){
            const errors = [];
            if(!this.$v.form.phone_number.$dirty){ return errors; }
            !this.$v.form.phone_number.maxLength && errors.push('Su número de teléfono no debe tener mas de 35 caracteres.');
            !this.$v.form.phone_number.numeric && errors.push('Este campo solo admite caracteres numéricos.');
            return errors;
         },

         emailErrors(){
            const errors = [];
            if(!this.$v.form.email.$dirty){ return errors; }
            !this.$v.form.email.maxLength && errors.push('Su correo electrónico no debe tener mas de 35 caracteres.');
            !this.$v.form.email.email && errors.push('El texto ingresado no corresponde con un correo electrónico.');
            !this.$v.form.email.required && errors.push('Este campo es obligatorio.');
            this.$v.form.email.isUnique && errors.push("Esta dirección de correo electrónico ya ha sido registrada.");
            return errors;
         },
      },

      methods:{

         unique(url){
            return axios.get(url)
               .then((response) => {
                  this.usernameFieldLoading = false;
                  this.emailFieldLoading = false;
                  return response.data;
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         submit(){
            console.log("ContactDataForm.vue component submited...!");
         }
      }
   }

</script>
