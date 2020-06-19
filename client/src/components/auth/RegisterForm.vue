
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
            class="ma-0 pa-0 mt-1" :rules="name" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.password" label="Contraseña" type="password"
            class="ma-0 pa-0 mt-1" :rules="name" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.re_password" label="Repita su Contraseña" type="password"
            class="ma-0 pa-0 mt-1" :rules="name" dense required></v-text-field>

         <v-btn type="submit" color="blue lighten-1 text-capitalize" dark depressed>Enviar</v-btn>
         <v-btn type="submit" color="grey lighten-1 text-capitalize ml-2" light depressed>Borrar campos</v-btn>
      </v-form>

   </div>

</template>

<script>

   export default {

      data(){
         return {

            form: {
               name: "",
               lastname: "",
               country: "",
               city: "",
               phone_number: "",
               email: "",
               username: "",
               password: "",
               re_password: ""
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
               this.emailValidation,
               this.alphanumericValidation,
               this.charNum15Validation,
               this.noSpacesValidation
            ],

            password: [
               this.emptyValidation,
               this.charNum35Validation,
               this.matchPasswordsValidation
            ]
         }
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

         alphanumericValidation(v){
            return v ? /[ a-zA-Z0-9]+$/.test(v) || "Solo se permiten caracteres alfanuméricos en este campo." : true;
         },

         alphabeticalValidation(v){
            return v ? /[ a-zA-Z]+$/.test(v) || "Solo se permiten caracteres alfabéticos en este campo." : true;
         },

         emailValidation(v){
            let regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return v ? regex.test(v) || "El texto no corresponde con una dirección de correo electrónico." : true;
         },

         positiveNumValidation(v){
            return v ? parseInt(v, 10) > 0 || "Este campo no permite valores numéricos negativos." : true;
         },

         matchPasswordsValidation(){
            return this.form.password == this.form.re_password;
         },

         // ************************************************

         submit(){
            if(this.$refs.loginForm.validate()){
               // this.loginAction(this.form)
               //    .then(() => {
               //       this.$router.push({name: "profile", params: {username: this.user.username}});
               //    })
               //    .catch((error) => {
               //       console.log(error);
               //    });
            }
         }
      }

   }

</script>
