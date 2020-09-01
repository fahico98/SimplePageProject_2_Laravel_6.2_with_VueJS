
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.name" label="Nombre" class="ma-0 pa-0"
               @input="$v.form.name.$touch()" @blur="$v.form.name.$touch()" :error-messages="nameErrors" outlined dense
               required></v-text-field>

            <v-text-field color="blue lighten-1" v-model.trim="form.lastname" label="Apellido" class="ma-0 pa-0 mt-1"
               @input="$v.form.lastname.$touch()" @blur="$v.form.lastname.$touch()" :error-messages="lastnameErrors" outlined
               dense required></v-text-field>

            <v-text-field color="blue lighten-1" v-model.trim="form.username" label="Apellido" class="ma-0 pa-0 mt-1"
               @input="$v.form.username.$touch()" @blur="$v.form.username.$touch()" :error-messages="usernameErrors"
               :loading="usernameFieldLoading" outlined dense required></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-textarea outlined no-resize dense cols="20" rows="6" counter="120" label="Biografía" :v-model="form.bio"
               @input="$v.form.bio.$touch()" @blur="$v.form.bio.$touch()" :error-messages="bioErrors"/>

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
   import { helpers, minLength, maxLength, required } from "vuelidate/lib/validators";

   const alpha = helpers.regex("alpha", /^[ ñÑ.a-zA-Z]*$/);
   const alphaNum = helpers.regex("alphaNum", /^[ñÑa-zA-Z0-9]*$/)
   const spanish = helpers.regex("spanish", /[ñÑ]/);

   export default {

      mixins: [validationMixin],

      props: [
         "nameProp",
         "lastnameProp",
         "usernameProp",
         "bioProp"
      ],

      data(){
         return {

            form: {
               name: "",
               lastname: "",
               username: "",
               bio: ""
            },

            usernameFieldLoading: false
         }
      },

      validations: {
         form: {
            name:                         {alpha, required, maxLength: maxLength(35)},
            lastname:                     {alpha, required, maxLength: maxLength(35)},
            username:                     {
                                             alphaNum,
                                             spanish,
                                             required,
                                             minLength: minLength(6),
                                             maxLength: maxLength(15),
                                             isUnique(value){
                                                if (value === ''){ return true; }
                                                this.usernameFieldLoading = true;
                                                return this.unique("auth/username_exists/" + value);
                                             }
                                          },
            bio:                          {alphaNum, required, maxLength: maxLength(120)}
         }
      },

      computed: {

         nameErrors(){
            const errors = [];
            if(!this.$v.form.name.$dirty){ return errors; }
            !this.$v.form.name.maxLength && errors.push('Su nombre no debe tener mas de 35 caracteres.');
            !this.$v.form.name.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            !this.$v.form.name.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         lastnameErrors(){
            const errors = [];
            if(!this.$v.form.lastname.$dirty){ return errors; }
            !this.$v.form.lastname.maxLength && errors.push('Su apellido no debe tener mas de 35 caracteres.');
            !this.$v.form.lastname.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            !this.$v.form.lastname.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         usernameErrors(){
            const errors = [];
            if(!this.$v.form.username.$dirty){ return errors; }
            !this.$v.form.username.maxLength && errors.push('Su nombre de usuario no debe tener mas de 15 caracteres.');
            !this.$v.form.username.minLength && errors.push('Su nombre de usuario debe tener al menos 6 caracteres.');
            !this.$v.form.username.alphaNum && errors.push("Este campo solo admite caracteres alfanuméricos.");
            !this.$v.form.username.required && errors.push("Este campo es obligatorio.");
            this.$v.form.username.isUnique && errors.push("Este nombre de usuario ya ha sido registrado.");
            if(this.$v.form.username.spanish){ errors.push('Este campo no debe contener ñ.'); }
            return errors;
         },

         bioErrors(){
            const errors = [];
            if(!this.$v.form.bio.$dirty){ return errors; }
            !this.$v.form.bio.maxLength && errors.push('Máximo 120 caracteres.');
            !this.$v.form.bio.alphaNum && errors.push('No se admite caracteres especiales.');
            !this.$v.form.bio.required && errors.push('La biografía no puede estar vacía.');
            return errors;
         }
      },

      methods: {

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
            console.log("ProfileDataForm.vue component submited...!");
         }
      }
   }

</script>
