
<template>

   <div style="display: inline">
      <v-dialog v-model="dialog" max-width="450px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn icon class="mx-0" color="blue lighten-1" v-ripple="false" v-bind="attrs" v-on="on">
               <v-icon>mdi-trash-can-outline</v-icon>
            </v-btn>
         </template>

         <v-card :loading="loading">

            <v-card-title class="headline pt-5">Eliminar publicación</v-card-title>

            <v-form class="mt-4 pa-0" @submit.prevent="">

               <p class="px-6">Esta seguro que desea eliminar esta publicación ?</p>

               <v-card-actions>

                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" v-ripple="false"
                     color="blue lighten-1">
                     <span class="px-2">Eliminar</span>
                  </v-btn>

                  <v-btn depressed light @click="dialog = false" class="mb-2 ml-3 text-capitalize" v-ripple="false"
                     color="grey lighten-1">
                     <span class="px-2">Cancelar</span>
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>

      </v-dialog>

      <v-snackbar dark v-model="snackbar" :timeout="5000" color="blue lighten-1">

         La publicación ha sido eliminada exitosamente.

         <template v-slot:action="{ attrs }">
            <v-btn text v-ripple="false" class="white--text text-capitalize" v-bind="attrs" @click="snackbar = false">Ok</v-btn>
         </template>

      </v-snackbar>

   </div>

</template>

<script>

   import axios from "axios";

   export default {

      data(){
         return {
            loading: false,
            dialog: false,
            snackbar: false
         }
      },

      props: {
         postId: {
            type: Number
         }
      },

      methods: {

         submit(){
            if(!this.loading){
               this.loading = "blue lighten-1";
               axios.delete("posts/delete/" + this.postId)
                  .then((response) => {
                     if(response.data){
                        console.log(response.data);
                        this.dialog = false;
                        this.loading = false;
                        this.snackbar = true;
                     }
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         }
      }
   }

</script>
