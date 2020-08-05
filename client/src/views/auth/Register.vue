
<template>

   <v-container class="my-5">
      <v-row class="ma-0 pa-0 my-10">

         <v-col cols="5" class="ma-0 pa-0">
            <v-card elevation="2" class="pa-8">
               <p class="ma-0 pa-0 mb-6 text-h5">Ingrese sus datos personales</p>
               <p class="ma-0 pa-0 subtitle-1">Toda la información ingresada en este formulario será manejada y resguardada según
                   nuestras politicas de privacidad. Si ya tiene una cuenta puede <a href="#"
                  @click.prevent="$router.push({name: 'login'})">iniciar sesión</a> con sus credenciales.</p>
               <register-form class="mt-10"></register-form>
            </v-card>
         </v-col>

         <v-col cols="7" align-self="start" class="ma-0 pa-0">
            <v-row justify="end">
               <img src="../../assets/unDraw/undraw_profile_edited.png" alt="Login" height="400px">
               <!-- <huge-logo-animation logos-height="350px"/> -->
            </v-row>
         </v-col>

      </v-row>
   </v-container>

</template>

<script>

   import RegisterForm from "../../components/auth/RegisterForm";

   export default {

      components: {
         RegisterForm
      }
   }

</script>
