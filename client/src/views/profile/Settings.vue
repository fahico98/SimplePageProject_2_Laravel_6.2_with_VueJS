
<template>

   <v-container class="ma-0 pa-0">

      <!-- <left-bar class="grey lighten-4"/> -->
      <right-bar class="grey lighten-4"/>

      <div class="mx-15 my-10">

         <v-container class="ma-0 pa-0">

            <v-row class="d-flex align-center ma-0 pa-0">
               <v-icon color="blue lighten-1">mdi-account-outline</v-icon>
               <span class="mr-4 ml-1 text-body-2 font-weight-bold blue--text text--lighten-1">
                  Perfil
               </span>
               <v-divider/>
            </v-row>

            <v-row class="d-flex align-center mx-0 pa-0 mt-10 mb-10">
               <span class="text-body-2">
                  Estos datos se muestran en la pagina de tu perfil junto con tu ubicación y tus datos de contacto.
                  Recuerda que si cambias tu nombre de usuario la url que enlaza tu pagina de perfil cambiará, por tanto,
                  el enlace antiguo no será valido en para cualquier persona que intente llegar a tu perfil por medio de él.
               </span>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0 my-5">
               <profile-data-form/>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0">
               <v-icon color="blue lighten-1">mdi-map-marker-outline</v-icon>
               <span class="mr-4 ml-1 text-body-2 font-weight-bold blue--text text--lighten-1">
                  Ubicación
               </span>
               <v-divider/>
            </v-row>

            <v-row class="d-flex align-center mx-0 pa-0 mt-10 mb-10">
               <span class="text-body-2">
                  Estos datos se muestrarán tu pagina de perfil si así lo deseas, tienes la opción de mostrarselo solamente
                  a las personas que te siguén o puedes hacer que sea visible solo para tí.
               </span>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0 my-5">
               <location-data-form/>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0">
               <v-icon color="blue lighten-1">mdi-email-outline</v-icon>
               <span class="mr-4 ml-1 text-body-2 font-weight-bold blue--text text--lighten-1">
                  Contacto
               </span>
               <v-divider/>
            </v-row>

            <v-row class="d-flex align-center mx-0 pa-0 mt-10 mb-10">
               <span class="text-body-2">
                  Los datos de contacto se muestran en tu perfil según tus preferencias, puedes hacerlos visibles para
                  todo el mundo, solo para tus seguidores o para nadie. Recuerda que si quieres cambiar tu correo electrónico
                  deberas validar la cuenta tu nueva cuenta de correo, hasta que no lo hagas no podrás volver a ingresar a
                  tu cuenta.
               </span>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0 my-5">
               <contact-data-form/>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0">
               <v-icon color="blue lighten-1">mdi-post-outline</v-icon>
               <span class="mr-4 ml-1 text-body-2 font-weight-bold blue--text text--lighten-1">
                  Publicaciones
               </span>
               <v-divider/>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0">
               <v-icon color="blue lighten-1">mdi-lock-outline</v-icon>
               <span class="mr-4 ml-1 text-body-2 font-weight-bold blue--text text--lighten-1">
                  Seguridad
               </span>
               <v-divider/>
            </v-row>

            <v-row class="d-flex align-center mx-0 pa-0 mt-10 mb-10">
               <span class="text-body-2">
                  Los datos de contacto se muestran en tu perfil según tus preferencias, puedes hacerlos visibles para
                  todo el mundo, solo para tus seguidores o para nadie. Recuerda que si quieres cambiar tu correo electrónico
                  deberas validar la cuenta tu nueva cuenta de correo, hasta que no lo hagas no podrás volver a ingresar a
                  tu cuenta.
               </span>
            </v-row>

            <v-row class="d-flex align-center ma-0 pa-0 my-5">
               <password-form/>
            </v-row>

         </v-container>

      </div>

   </v-container>

</template>

<script>

   // import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import ProfileDataForm from "../../components/profile/settings/ProfileDataForm";
   import LocationDataForm from "../../components/profile/settings/LocationDataForm";
   import ContactDataForm from "../../components/profile/settings/ContactDataForm";
   import PasswordForm from "../../components/profile/settings/PasswordForm";

   export default {

      components: {
         // LeftBar,
         RightBar,
         ProfileDataForm,
         LocationDataForm,
         ContactDataForm,
         PasswordForm
      }

   }

</script>
