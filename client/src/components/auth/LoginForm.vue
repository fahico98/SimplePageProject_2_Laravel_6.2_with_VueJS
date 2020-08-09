
<template>

   <div>

      <v-form ref="loginForm" class="ma-0 pa-0" @submit.prevent="submit()" lazy-validation>

         <v-text-field outlined color="blue lighten-1" v-model="form.username" label="Nombre de usuario" class="ma-0 pa-0"
            :rules="usernameValidation" dense required></v-text-field>

         <v-text-field outlined color="blue lighten-1" v-model="form.password" label="Contraseña" type="password"
            class="ma-0 pa-0 mt-1" :rules="passwordValidation" dense required></v-text-field>

         <v-checkbox dense class="ma-0 pa-0 mt-1" color="blue lighten-1" v-model="form.rememberMe" label="Recuerdame"></v-checkbox>

         <v-btn type="submit" class="mt-2" color="blue lighten-1 text-capitalize" dark depressed>Enviar</v-btn>

      </v-form>

   </div>

</template>

<script>

   import { mapActions, mapGetters } from "vuex";

   export default {

      data(){
         return {
            form: {
               username: "",
               password: "",
               rememberMe: false
            },
            usernameValidation: [
               value => !!value || 'El nombre de usuario es obligatorio.'
            ],
            passwordValidation: [
               value => !!value || 'La contraseña es obligatoria.'
            ],
         }
      },

      computed: {
         ...mapGetters({
            user: "auth/user"
         })
      },

      methods: {

         ...mapActions({
            loginAction: "auth/loginAction"
         }),

         submit(){
            if(this.$refs.loginForm.validate()){
               this.loginAction(this.form)
                  .then(() => {
                     this.$router.push({name: "posts", params: {username: this.user.username}});
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         }
      }
   }

</script>
