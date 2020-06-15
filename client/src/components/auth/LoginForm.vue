
<template>

   <div>

      <v-form class="ma-0 pa-0" @submit.prevent="submit">
         <v-text-field outlined color="blue lighten-1" v-model="form.username" label="Nombre de usuario" class="ma-0 pa-0"
            dense required></v-text-field>
         <v-text-field outlined color="blue lighten-1" v-model="form.password" label="Contraseña" type="password" class="ma-0 pa-0"
            dense required></v-text-field>
         <v-checkbox dense class="ma-0 pa-0" color="blue lighten-1" v-model="form.rememberMe" label="Recuerdame"></v-checkbox>
         <v-btn type="submit" color="blue lighten-1 text-capitalize" dark depressed>Enviar</v-btn>
      </v-form>

   </div>

</template>

<script>

   import { mapActions } from "vuex";

   export default {

      data(){
         return {
            form: {
               username: "",
               password: "",
               rememberMe: false
            }
         }
      },

      methods: {

         ...mapActions({
            login: "auth/loginAction"
         }),

         submit(){
            this.login(this.form);
         }
      }
   }

</script>
