
<template>


   <v-container class="my-5">
      <v-row class="ma-0 pa-0 my-10">

         <v-col cols="4" class="ma-0 pa-0">
            <v-card elevation="2" class="pa-8">
               <p class="ma-0 pa-0 mb-6 text-h5">Inicie sesión con su nombre de usuario y contraseña</p>
               <p class="ma-0 pa-0 subtitle-1">Si no tiene una cuenta y desea adquirir una puede <a href="#"
                  @click.prevent="$router.push({name: 'register'})">registrarse</a> con sus datos personales.</p>
               <login-form class="mt-10"></login-form>
               <p class="subtitle-1 mt-10"><a href="#">¿Olvidó su contraseña?</a></p>
            </v-card>
         </v-col>

         <v-col cols="8" align-self="center" class="ma-0 pa-0">
            <v-row justify="end">
               <img src="../../assets/unDraw/undraw_two_factor_authentication_namy_edited.png" alt="Login" height="460px">
               <!-- <huge-logo-animation logos-height="350px"/> -->
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
      }
   }

</script>
