
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

            <v-form class="mt-5 pa-0" @submit.prevent="">

               <p class="px-6">Esta seguro que desea eliminar esta publicación ?</p>

               <v-card-actions>

                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                     <span class="px-2">Eliminar</span>
                  </v-btn>

                  <v-btn depressed light @click="dialog = false" class="mb-2 ml-3 text-capitalize" color="grey lighten-1">
                     <span class="px-2">Cancelar</span>
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>

      </v-dialog>
   </div>

</template>

<script>

   import axios from "axios";

   export default {

      data(){
         return {
            loading: false,
            dialog: false
         }
      },

      props: {
         postId: {
            type: Number
         }
      },

      methods: {

         submit(){
            this.loading = "blue lighten-1";
            axios.delete("posts/delete/" + this.postId)
               .then((response) => {
                  if(response.data){
                     console.log(response.data);
                     this.dialog = false;
                     this.loading = false;
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         }
      }
   }

</script>
