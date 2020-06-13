
<template>

   <v-container fluid>

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0">
            <p class="ma-0 pa-0 mb-2 text-h5">Inicie sesión con su nombre de usuario y contraseña</p>
            <p class="ma-0 pa-0 subtitle-1">Si no tiene una cuenta y desea adquirir una puede <a href="#" @click.prevent="$router.push({name: 'register'})">registrarse</a> con sus datos personales.</p>
            <login-form class="mt-10"></login-form>
            <p class="subtitle-1 mt-10"><a href="#">¿Olvidó su contraseña?</a></p>
         </v-col>

         <v-col v-show="showVueLogo" cols="6" class="ma-0 pa-0">
            <v-row justify="center">
               <transition name="vue-logo">
                  <div class="vue-logo-container" v-show="showVueLogo">
                     <img src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png" alt="Vue logo" width="400px">
                  </div>
               </transition>
            </v-row>
         </v-col>

      </v-row>

   </v-container>

</template>

<script>

   import LoginForm from "../../components/auth/LoginForm";

   export default {

      components: {
         LoginForm
      },

      data(){
         return {
            showVueLogo: true
         }
      },

      mounted(){
         /*
         while(true){
            setTimeout(() => { this.showVueLogo = !this.showVueLogo; }, 10000);
         }
         */
      }
   }

</script>

<style scoped>

   .vue-logo-enter-active, .vue-logo-leave-active {
      transition: transform 0.3s ease-in-out, opacity 0.3s ease;
   }

   .vue-logo-enter { /* Enter from */
      transform: translateY(80px) rotateZ(360deg);
      opacity: 0;
   }

   .vue-logo-leave-to { /* Leave to */
      transform: translateY(80px) rotateZ(-360deg);
      opacity: 0;
   }

   .vue-logo-enter-to, .vue-logo-leave { /* Enter to and Leave from */
      transform: translateY(0px) rotateZ(0deg);
      opacity: 1;
   }

</style>
