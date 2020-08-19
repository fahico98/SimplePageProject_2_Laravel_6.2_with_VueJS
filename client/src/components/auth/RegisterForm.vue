
<template>

   <div>
      <v-form ref="registerForm" class="ma-0 pa-0" @submit.prevent="submit">

         <v-text-field color="blue lighten-1" v-model.trim="form.name" label="Nombre" class="ma-0 pa-0 mt-1"
            @input="$v.form.name.$touch()" @blur="$v.form.name.$touch()" :error-messages="nameErrors" outlined dense
            required></v-text-field>

         <v-text-field color="blue lighten-1" v-model.trim="form.lastname" label="Apellido" class="ma-0 pa-0 mt-1"
            @input="$v.form.lastname.$touch()" @blur="$v.form.lastname.$touch()" :error-messages="lastnameErrors" outlined
            dense required></v-text-field>

         <v-text-field color="blue lighten-1" v-model.trim="form.country" label="País" class="ma-0 pa-0 mt-1"
            @input="$v.form.country.$touch()" @blur="$v.form.country.$touch()" :error-messages="countryErrors" outlined
            dense></v-text-field>

         <v-text-field color="blue lighten-1" v-model.trim="form.city" label="Ciudad" class="ma-0 pa-0 mt-1"
            @input="$v.form.city.$touch()" @blur="$v.form.city.$touch()" :error-messages="cityErrors" outlined dense>
            </v-text-field>

         <v-text-field color="blue lighten-1" v-model.trim="form.phone_number" class="ma-0 pa-0 mt-1" label="Número telefónico"
            @input="$v.form.phone_number.$touch()" @blur="$v.form.phone_number.$touch()" :error-messages="phoneNumberErrors"
            type="number" outlined dense></v-text-field>

         <v-text-field color="blue lighten-1" v-model.trim="form.email" class="ma-0 pa-0 mt-1" label="Correo electrónico"
            @input="$v.form.email.$reset()" @blur="$v.form.email.$touch()" :error-messages="emailErrors"
            :loading="emailFieldLoading" outlined dense required></v-text-field>

         <v-text-field color="blue lighten-1" v-model="form.username" label="Nombre de usuario" class="ma-0 pa-0 mt-1"
            @input="$v.form.username.$reset()" @blur="$v.form.username.$touch()" :error-messages="usernameErrors"
            :loading="usernameFieldLoading" outlined dense required></v-text-field>

         <v-text-field color="blue lighten-1" v-model="form.password" label="Contraseña" class="ma-0 pa-0 mt-1"
            @input="$v.form.password.$touch()" @blur="$v.form.password.$touch()" :error-messages="passwordErrors"
            type="password" outlined dense required></v-text-field>

         <v-text-field color="blue lighten-1" v-model="form.password_confirmation" label="Confirmación de contraseña"
            class="ma-0 pa-0 mt-1" @input="$v.form.password_confirmation.$touch()" @blur="$v.form.password_confirmation.$touch()"
            :error-messages="confPasswordErrors" type="password" outlined dense required></v-text-field>

         <v-btn class="mt-1" type="submit" color="blue lighten-1 text-capitalize" dark depressed>enviar</v-btn>

         <v-btn outlined depressed color="blue lighten-1" class="mt-1 ml-2 text-capitalize" @click="borrarCampos()">
            borrar campos
         </v-btn>

      </v-form>
   </div>

</template>

<script>

   import axios from "axios";
   import { mapActions, mapGetters } from "vuex";
   import { validationMixin } from "vuelidate";
   import { helpers, minLength, maxLength, email, required, numeric } from "vuelidate/lib/validators";

   const alpha = helpers.regex("alpha", /^[ ñÑ.a-zA-Z]*$/);
   const alphaNum = helpers.regex("alphaNum", /^[ñÑa-zA-Z0-9]*$/)
   const spanish = helpers.regex("spanish", /[ñÑ]/);

   export default {

      mixins: [validationMixin],

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
               password_confirmation: "",
               rememberMe: false
            },

            usernameFieldLoading: false,
            emailFieldLoading: false

         }
      },

      validations: {
         form: {
            name:                         {alpha, required, maxLength: maxLength(35)},
            lastname:                     {alpha, required, maxLength: maxLength(35)},
            country:                      {alpha, maxLength: maxLength(35)},
            city:                         {alpha, maxLength: maxLength(35)},
            phone_number:                 {numeric, maxLength: maxLength(35)},
            password:                     {required, minLength: minLength(8), maxLength: maxLength(35)},
            password_confirmation:        {required},

            email:                        {
                                             email,
                                             required,
                                             maxLength: maxLength(35),
                                             isUnique(value){
                                                if (value === ''){ return true; }
                                                this.emailFieldLoading = true;
                                                return this.unique("auth/email_exists/" + value);
                                             }
                                          },

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
                                          }
         }
      },

      computed: {

         ...mapGetters({
            user: "auth/user"
         }),

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
         },

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

         passwordErrors(){
            const errors = [];
            if(!this.$v.form.password.$dirty){ return errors; }
            !this.$v.form.password.maxLength && errors.push('Su contraseña no debe tener mas de 35 caracteres.');
            !this.$v.form.password.minLength && errors.push('Su contraseña debe tener al menos 8 caracteres.');
            !this.$v.form.password.required && errors.push('La contraseña es obligatoria.');
            return errors;
         },

         confPasswordErrors(){
            const errors = [];
            if(!this.$v.form.password.$dirty){ return errors; }
            if(this.form.password != this.form.password_confirmation){ errors.push('Las contraseñas no coinciden.'); }
            !this.$v.form.password.required && errors.push('La confirmación de contraseña es obligatoria.');
            return errors;
         }
      },

      methods: {

         ...mapActions({
            registerAction: "auth/registerAction",
            loginAction: "auth/loginAction"
         }),

         // Esta función no está bien optimizada...
         submit(){
            this.$v.$touch();
            if(!this.$v.$invalid){
               this.registerAction(this.form)
                  .then((response) => {
                     if(response.status == 201){
                        this.loginAction(this.form)
                           .then(() => {
                              this.$router.push({name: "profile", params: {username: this.user.username}});
                           })
                           .catch((error) => {
                              console.log(error);
                           });
                     }
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         },

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

         borrarCampos(){
            this.$v.form.$reset();
            this.name = "";
            this.lastname = "";
            this.country = "";
            this.city = "";
            this.phone_number = "";
            this.email = "";
            this.username = "";
            this.password = "";
            this.password_confirmation = "";
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
