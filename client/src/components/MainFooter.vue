
<template>

   <v-footer class="font-weight-medium grey lighten-4 white--text text-center" absolute app>
      <v-container fluid>

         <v-row justify="center">
            <v-btn v-for="icon in icons" :key="icon.iconName" class="mx-4 blue--text text--lighten-1" icon>
               <v-icon :title="icon.iconTitle" size="30px">{{ icon.iconName }}</v-icon>
            </v-btn>
         </v-row>

         <v-row class="mb-3 mt-6 pa-0" justify="center">
            <p class="body-2 blue--text text--lighten-1">Diseñado por <strong>Fahico Studio</strong>.</p>
         </v-row>

         <v-divider></v-divider>

         <v-row class="mb-0 mt-4 pa-0" justify="center">
            <p class="body-2 font-weight-bold blue--text text--lighten-1">{{ new Date().getFullYear() }} — Vuetify</p>
         </v-row>

      </v-container>
   </v-footer>

</template>

<script>

   export default {

      data(){
         return {
            icons: [
               {
                  iconName: 'mdi-facebook',
                  iconTitle: "Facebook"
               },
               {
                  iconName: 'mdi-twitter',
                  iconTitle: "Twitter"
               },
               {
                  iconName: 'mdi-linkedin',
                  iconTitle: "Linked In"
               },
               {
                  iconName: 'mdi-instagram',
                  iconTitle: "Instagram"
               }
            ]
         }
      }
   }

</script>
