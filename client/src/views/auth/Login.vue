
<template>

   <v-container fluid>

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0">
            <p class="ma-0 pa-0 mb-2 text-h5">Inicie sesión con su nombre de usuario y contraseña</p>
            <p class="ma-0 pa-0 mt-3 subtitle-1">Si no tiene una cuenta y desea adquirir una puede <a href="#" @click.prevent="$router.push({name: 'register'})">registrarse</a> con sus datos personales.</p>
            <login-form class="mt-10"></login-form>
            <p class="subtitle-1 mt-10"><a href="#">¿Olvidó su contraseña?</a></p>
         </v-col>

         <v-col cols="6" align-self="center" class="ma-0 pa-0">
            <v-row justify="center">
               <huge-logo-animation logos-height="350px"/>
            </v-row>
         </v-col>

      </v-row>

   </v-container>

</template>

<script>

   import LoginForm from "../../components/auth/LoginForm";
   import HugeLogoAnimation from "../../components/animations/HugeLogoAnimation";

   export default {

      components: {
         LoginForm,
         HugeLogoAnimation
      }
   }

</script>
