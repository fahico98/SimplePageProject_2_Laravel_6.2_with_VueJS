
<template>

   <div>
      <v-form ref="registerForm" class="ma-0 pa-0" @submit.prevent="submit">

         <v-text-field outlined color="blue lighten-1" v-model="form.name" label="Nombre" class="ma-0 pa-0 mt-1"
            :rules="name" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.lastname" label="Apellido" class="ma-0 pa-0 mt-1"
            :rules="name" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.country" label="País" class="ma-0 pa-0 mt-1"
            :rules="city" dense></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.city" label="Ciudad" class="ma-0 pa-0 mt-1"
            :rules="city" dense></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.phone_number" label="Número telefónico"
            class="ma-0 pa-0 mt-1" :rules="phone_number" type="number" dense></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.email" label="Correo electrónico"
            class="ma-0 pa-0 mt-1" :rules="email" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.username" label="Nombre de usuario"
            class="ma-0 pa-0 mt-1" :rules="username" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.password" label="Contraseña" type="password"
            class="ma-0 pa-0 mt-1" :rules="password" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.password_confirmation" label="Repita su Contraseña"
            type="password" class="ma-0 pa-0 mt-1" :rules="password_confirmation" dense required></v-text-field>

         <v-btn class="mt-1" type="submit" color="blue lighten-1 text-capitalize" dark depressed>Enviar</v-btn>
         <v-btn class="mt-1" type="submit" color="grey lighten-1 text-capitalize ml-2" @click="borrarCampos()" light depressed>
            Borrar campos</v-btn>

      </v-form>
   </div>

</template>

<script>

   import { mapActions, mapGetters } from "vuex";

   export default {

      data(){
         return {

            form: {
               name: "",
               lastname: "",
               country: "",
               city: "",
               phone_number: null,
               email: "",
               username: "",
               password: "",
               password_confirmation: ""
            },

            name: [
               this.emptyValidation,
               this.charNum25Validation,
               this.alphabeticalValidation
            ],

            city: [
               this.charNum25Validation,
               this.alphabeticalValidation
            ],

            phone_number: [
               this.charNum15Validation,
               this.positiveNumValidation
            ],

            email: [
               this.emptyValidation,
               this.emailValidation,
               this.noSpacesValidation,
               this.charNum35Validation
            ],

            username: [
               this.emptyValidation,
               this.alphanumericValidation,
               this.charNum15Validation,
               this.noSpacesValidation
            ],

            password: [
               this.emptyValidation,
               this.charNum35Validation,
               this.charMinNum8Validation
            ],

            password_confirmation: [
               this.emptyValidation,
               this.charNum35Validation,
               this.matchPasswordsValidation,
               this.charMinNum8Validation
            ]
         }
      },

      computed: {
         ...mapGetters({
            user: "auth/user"
         })
      },

      methods: {

         // ********** Validation fields methods **********

         emptyValidation(v){
            return !!v || "Este campo es obligatorio";
         },

         noSpacesValidation(v){
            return v ? v.indexOf(" ") == -1 || "No se permiten espacios en este campo." : true;
         },

         charNum15Validation(v){
            return v ? v.length <= 15 || "No se permiten mas de 15 caracteres." : true;
         },

         charNum25Validation(v){
            return v ? v.length <= 25 || "No se permiten mas de 25 caracteres." : true;
         },

         charNum35Validation(v){
            return v ? v.length <= 35 || "No se permiten mas de 35 caracteres." : true;
         },

         charMinNum8Validation(v){
            return v ? v.length >= 8 || "No se permiten menos de 8 caracteres." : true;
         },

         alphanumericValidation(v){
            return v ? /[ a-zA-Z0-9-.,]+$/.test(v) || "Solo se permiten caracteres alfanuméricos en este campo." : true;
         },

         alphabeticalValidation(v){
            return v ? /[ a-zA-Z-.,]+$/.test(v) || "Solo se permiten caracteres alfabéticos en este campo." : true;
         },

         emailValidation(v){
            let regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return v ? regex.test(v) || "El texto no corresponde con una dirección de correo electrónico." : true;
         },

         positiveNumValidation(v){
            return v ? parseInt(v, 10) > 0 || "Este campo no permite valores numéricos negativos." : true;
         },

         matchPasswordsValidation(){
            return this.form.password == this.form.password_confirmation ? true : "Las contraseñas no coinciden.";
         },

         // ************************************************

         ...mapActions({
            registerAction: "auth/registerAction"
         }),

         submit(){
            if(this.$refs.registerForm.validate()){

               this.registerAction(this.form);

               // this.loginAction(this.form)
               //    .then(() => {
               //       this.$router.push({name: "profile", params: {username: this.user.username}});
               //    })
               //    .catch((error) => {
               //       console.log(error);
               //    });
            }
         },

         borrarCampos(){
            this.form.name = "";
            this.form.lastname = "";
            this.form.country = "";
            this.form.city = "";
            this.form.phone_number = "";
            this.form.email = "";
            this.form.username = "";
            this.form.password = "";
            this.form.password_confirmation = "";
            this.$refs.registerForm.resetValidation()
         }
      }

   }

</script>

<style>

   input[type=number]::-webkit-outer-spin-button,
   input[type=number]::-webkit-inner-spin-button{
      -webkit-appearance: none;
      margin: 0;
   }

   input[type=number]{
      -moz-appearance: textfield;
   }

</style>
