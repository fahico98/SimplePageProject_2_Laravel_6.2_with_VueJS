
<template>

   <div>
      <v-form ref="registerForm" class="ma-0 pa-0" @submit.prevent="submit">

         <v-text-field
            color="blue lighten-1"
            v-model.trim="name"
            label="Nombre"
            class="ma-0 pa-0 mt-1"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
            :error-messages="nameErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="lastname"
            label="Apellido"
            class="ma-0 pa-0 mt-1"
            @input="$v.lastname.$touch()"
            @blur="$v.lastname.$touch()"
            :error-messages="lastnameErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="country"
            label="País"
            class="ma-0 pa-0 mt-1"
            @input="$v.country.$touch()"
            @blur="$v.country.$touch()"
            :error-messages="countryErrors"
            outlined
            dense
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="city"
            label="Ciudad"
            class="ma-0 pa-0 mt-1"
            @input="$v.city.$touch()"
            @blur="$v.city.$touch()"
            :error-messages="cityErrors"
            outlined
            dense
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="phone_number"
            class="ma-0 pa-0 mt-1"
            label="Número telefónico"
            @input="$v.phone_number.$touch()"
            @blur="$v.phone_number.$touch()"
            :error-messages="phoneNumberErrors"
            type="number"
            outlined
            dense
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="email"
            class="ma-0 pa-0 mt-1"
            label="Correo electrónico"
            @input="$v.email.$touch()"
            @blur="$v.email.$touch()"
            :error-messages="emailErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model.trim="username"
            label="Nombre de usuario"
            class="ma-0 pa-0 mt-1"
            @input="$v.username.$touch()"
            @blur="$v.username.$touch()"
            :error-messages="usernameErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model="password"
            label="Contraseña"
            class="ma-0 pa-0 mt-1"
            @input="$v.password.$touch()"
            @blur="$v.password.$touch()"
            :error-messages="passwordErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-text-field
            color="blue lighten-1"
            v-model="password_confirmation"
            label="Confirmación de contraseña"
            class="ma-0 pa-0 mt-1"
            @input="$v.password_confirmation.$touch()"
            @blur="$v.password_confirmation.$touch()"
            :error-messages="confPasswordErrors"
            outlined
            dense
            required
         ></v-text-field>

         <v-btn
            class="mt-1"
            type="submit"
            color="blue lighten-1 text-capitalize"
            dark depressed
         >Enviar</v-btn>

         <v-btn
            class="mt-1"
            type="submit"
            color="grey lighten-1 text-capitalize ml-2"
            @click="borrarCampos()"
            light
            depressed
         >Borrar campos</v-btn>

      </v-form>
   </div>

</template>

<script>

   import { mapActions, mapGetters } from "vuex";
   import { validationMixin } from "vuelidate";
   import {minLength, maxLength, email, required, alpha, alphaNum, numeric} from "vuelidate/lib/validators";

   export default {

      mixins: [validationMixin],

      data(){
         return {
            name: "",
            lastname: "",
            country: "",
            city: "",
            phone_number: null,
            email: "",
            username: "",
            password: "",
            password_confirmation: ""
         }
      },

      validations: {
         name:                         {alpha, required, maxLength: maxLength(25)},
         lastname:                     {alpha, required, maxLength: maxLength(25)},
         country:                      {alpha, maxLength: maxLength(25)},
         city:                         {alpha, maxLength: maxLength(25)},
         phone_number:                 {numeric, maxLength: maxLength(15)},
         email:                        {email, required, maxLength: maxLength(35)},
         username:                     {alphaNum, required, minLength: minLength(4), maxLength: maxLength(15)},
         password:                     {required, minLength: minLength(8), maxLength: maxLength(35)},
         password_confirmation:        {required}
      },

      computed: {

         ...mapGetters({
            user: "auth/user"
         }),

         nameErrors(){
            console.log("model: " + this.$v.name.$model);
            const errors = [];
            if(!this.$v.name.$dirty){ return errors; }
            !this.$v.name.maxLength && errors.push('Su nombre no debe tener mas de 25 caracteres.');
            !this.$v.name.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            !this.$v.name.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         lastnameErrors(){
            const errors = [];
            if(!this.$v.lastname.$dirty){ return errors; }
            !this.$v.lastname.maxLength && errors.push('Su apellido no debe tener mas de 25 caracteres.');
            !this.$v.lastname.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            !this.$v.lastname.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         countryErrors(){
            const errors = [];
            if(!this.$v.country.$dirty){ return errors; }
            !this.$v.country.maxLength && errors.push('El país no debe tener mas de 25 caracteres.');
            !this.$v.country.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            return errors;
         },

         cityErrors(){
            const errors = [];
            if(!this.$v.city.$dirty){ return errors; }
            !this.$v.city.maxLength && errors.push('La ciudad no debe tener mas de 25 caracteres.');
            !this.$v.city.alpha && errors.push('Este campo solo admite caracteres alfabeticos.');
            return errors;
         },

         phoneNumberErrors(){
            const errors = [];
            if(!this.$v.phone_number.$dirty){ return errors; }
            !this.$v.phone_number.maxLength && errors.push('Su número de teléfono no debe tener mas de 25 caracteres.');
            !this.$v.phone_number.numeric && errors.push('Este campo solo admite caracteres numéricos.');
            return errors;
         },

         emailErrors(){
            const errors = [];
            if(!this.$v.email.$dirty){ return errors; }
            !this.$v.email.maxLength && errors.push('Su correo electrónico no debe tener mas de 35 caracteres.');
            !this.$v.email.email && errors.push('El texto ingresado no corresponde con un correo electrónico.')
            !this.$v.email.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         usernameErrors(){
            const errors = [];
            if(!this.$v.username.$dirty){ return errors; }
            !this.$v.username.maxLength && errors.push('Su nombre de usuario no debe tener mas de 15 caracteres.');
            !this.$v.username.minLength && errors.push('Su nombre de usuario debe tener al menos 4 caracteres.');
            !this.$v.username.alphaNum && errors.push("Este campo solo admite caracteres alfanumericos.");
            !this.$v.username.required && errors.push('Este campo es obligatorio.');
            return errors;
         },

         passwordErrors(){
            const errors = [];
            if(!this.$v.password.$dirty){ return errors; }
            !this.$v.password.maxLength && errors.push('Su contraseña no debe tener mas de 35 caracteres.');
            !this.$v.password.minLength && errors.push('Su contraseña debe tener al menos 8 caracteres.');
            !this.$v.password.required && errors.push('La contraseña es obligatoria.');
            return errors;
         },

         confPasswordErrors(){
            const errors = [];
            if(!this.$v.password.$dirty){ return errors; }
            if(this.password != this.password_confirmation){ errors.push('Las contraseñas no coinciden.'); }
            !this.$v.password.required && errors.push('La confirmación de contraseña es obligatoria.');
            return errors;
         },

         form(){
            return {
               name: this.name,
               lastname: this.lastname,
               country: this.contry,
               city: this.city,
               phone_number: this.phone_number,
               email: this.email,
               username: this.username,
               password: this.password,
               password_confirmation: this.password_confirmation
            }
         }
      },

      methods: {

         ...mapActions({
            registerAction: "auth/registerAction"
         }),

         submit(){
            /*
            if(this.$refs.registerForm.validate() && this.usernameErrorMessage == [] && this.emailErrorMessage == []){
               this.registerAction(form)
                  .then((response) => {
                     console.log(response);
                  })
                  .catch((error) => {
                     console.log(error);
                     // if(error.response.data.errors){

                     // }
                  });
            }
            */
         },

         borrarCampos(){
            this.name = "";
            this.lastname = "";
            this.country = "";
            this.city = "";
            this.phone_number = "";
            this.email = "";
            this.username = "";
            this.password = "";
            this.password_confirmation = "";
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
