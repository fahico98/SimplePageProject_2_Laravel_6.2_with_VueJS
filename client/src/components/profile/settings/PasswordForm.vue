
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model="form.new_password" label="Nueva contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.new_password.$touch()" @blur="$v.form.new_password.$touch()" :error-messages="newPasswordErrors"
               type="password" outlined dense required/>

            <v-text-field color="blue lighten-1" v-model="form.new_password_confirmation" label="Confirmación de nueva contraseña"
               class="ma-0 pa-0 mt-1" @input="$v.form.new_password_confirmation.$touch()" outlined dense required type="password"
               @blur="$v.form.new_password_confirmation.$touch()" :error-messages="newPasswordConfErrors"/>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model="form.old_password" label="Antigua contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.old_password.$touch()" @blur="$v.form.old_password.$touch()" :error-messages="oldPasswordErrors"
               :loading="oldPasswordFieldLoading" type="password" outlined dense required/>

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
               new_password: "",
               new_password_confirmation: "",
               old_password: ""
            },

            oldPasswordFieldLoading: false
         }
      },

      validations: {
         form: {
            new_password: {required, minLength: minLength(8), maxLength: maxLength(35)},
            new_password_confirmation: {required},
            old_password: {required}
         }
      },

      computed: {

         newPasswordErrors(){
            const errors = [];
            if(!this.$v.form.new_password.$dirty){ return errors; }
            !this.$v.form.new_password.maxLength && errors.push('Su contraseña no debe tener mas de 35 caracteres.');
            !this.$v.form.new_password.minLength && errors.push('Su contraseña debe tener al menos 8 caracteres.');
            !this.$v.form.new_password.required && errors.push('La contraseña es obligatoria.');
            return errors;
         },

         newPasswordConfErrors(){
            const errors = [];
            if(!this.$v.form.new_password_confirmation.$dirty){ return errors; }
            if(this.form.new_password_confirmation != this.form.new_password){ errors.push('Las contraseñas no coinciden.'); }
            !this.$v.form.new_password_confirmation.required && errors.push('La confirmación de contraseña es obligatoria.');
            return errors;
         },

         oldPasswordErrors(){
            return "";
         }
      }
   }

</script>
