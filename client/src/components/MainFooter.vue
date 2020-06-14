
<template>

   <v-card flat tile height="50">

      <v-footer class="font-weight-medium blue lighten-1 white--text text-center">
         <v-col class="text-center" cols="12">

            <v-card-text class="mt-0">
               <v-btn v-for="icon in icons" :key="icon.iconName" class="mx-4 white--text" icon>
                  <v-icon :title="icon.iconTitle" size="30px">{{ icon.iconName }}</v-icon>
               </v-btn>
            </v-card-text>

            <v-card-text class="my-5 pt-0">
               Diseñado por <strong>Fahico Studio</strong>.
            </v-card-text>

            <v-divider></v-divider>

            <v-card-text class="ma-0 pa-0 mt-5">
               {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
            </v-card-text>

         </v-col>
      </v-footer>

   </v-card>

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
