
<template>

   <div style="display: inline">
      <v-dialog scrollable v-model="dialog" max-width="400px" max-height="500px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn dark depressed v-ripple="false" color="blue lighten-1" width="100%" class="text-capitalize mb-5"
               v-bind="attrs" v-on="on">Nuevo mensaje</v-btn>
         </template>

         <v-card :loading="loading">

            <v-card-title class="headline pt-5">Buscar usuario</v-card-title>

            <v-card-text class="pt-0">
               Puedes enviar mensajes instantaneos a cualquiera de los usuarios que estas siguiendo.
            </v-card-text>

               <v-text-field dense outlined color="blue lighten-1" label="Nombre de usuario" class="px-5"
                  append-icon="mdi-magnify" v-model="browsedUsername" @input="search()" :loading="browsing"/>

               <v-divider></v-divider>

               <v-card-text style="height: 300px;">


               </v-card-text>

               <v-divider></v-divider>

               <v-card-actions class="ma-2">
                  <v-btn depressed light v-ripple="false" class="text-capitalize" color="grey lighten-1" @click="dialog = false">
                     <span class="px-2">Cancelar</span>
                  </v-btn>
               </v-card-actions>

         </v-card>

      </v-dialog>
   </div>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            browsedUsername: "",
            dialog: false,
            loading: false,
            browsing: false,
            follower: []
         }
      },

      computed: {

         ...mapGetters({
            user: "auth/user"
         }),
      },

      methods: {

         search(){
            this.browsing = "blue lighten-1";
            axios.get(`search_followed/${this.username}`)
               .then((response) => {
                  if(response.data){
                     console.log(response.data);
                     this.browsing = false;
                  }
               })
               .catch((error) => {
                  console.log(error)
               });
         }
      }
   }

</script>
