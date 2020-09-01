
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model="form.new_password" label="Nueva contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.new_password.$touch()" @blur="$v.form.new_password.$touch()" :error-messages="passwordErrors"
               type="password" outlined dense required></v-text-field>

            <v-text-field color="blue lighten-1" v-model="form.password_confirmation" label="Confirmación de nueva contraseña"
               class="ma-0 pa-0 mt-1" @input="$v.form.password_confirmation.$touch()" outlined dense
               @blur="$v.form.password_confirmation.$touch()" :error-messages="confPasswordErrors" type="password" required/>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model="form.password" label="Antigua contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.password.$touch()" @blur="$v.form.password.$touch()" :error-messages="passwordErrors"
               :loading="passwordFieldLoading" type="password" outlined dense required></v-text-field>

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
   import { minLength, maxLength, required } from "vuelidate/lib/validators";

   export default {

      mixins: [validationMixin],

      data(){
         return {

            form: {
               password: "",
               new_password: "",
               password_confirmation: ""
            },

            passwordFieldLoading: false
         }
      },

      validations: {
         form: {
            password: {required},
            new_password: {required, minLength: minLength(8), maxLength: maxLength(35)},
            password_confirmation: {required}
         }
      }
   }

</script>
