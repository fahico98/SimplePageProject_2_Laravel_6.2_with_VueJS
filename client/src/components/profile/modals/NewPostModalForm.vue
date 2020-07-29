
<template>

   <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">
         <template v-slot:activator="{ on, attrs }">
            <v-btn color="blue-lighten-1" class="text-capitalize" dark v-bind="attrs" v-on="on">open dialog</v-btn>
         </template>

         <v-card>

            <v-card-title class="headline">Nuevo post</v-card-title>

            <v-form class="mt-5 pa-0" @submit.prevent="">

               <v-text-field dense outlined color="blue lighten-1" label="Título" class="px-5" v-model="title"/>

               <v-textarea no-resize outlined v-model="content" counter="255" color="blue lighten-1" rows="4" class="px-5"
                  label="Contenido"/>

               <v-file-input small-chips multiple outlined dense color="blue lighten-1" prepend-icon="mdi-image-multiple"
                  class="px-5" label="Fotos del post"></v-file-input>

               <v-select outlined dense :items="items" color="blue lighten-1" label="Quien puede ver este post ?"
                  class="px-5" prepend-icon="mdi-lock"></v-select>

               <v-card-actions>

                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                     <span class="px-2">Publicar</span>
                  </v-btn>

                  <v-btn depressed light @click="limpiarCampos()" class="mb-2 ml-3 text-capitalize" color="grey lighten-1">
                     <span class="px-2">Limpiar campos</span>
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>
      </v-dialog>
   </v-row>

</template>

<script>

   export default {

      data(){
         return {
            dialog: false,
            title: "",
            content: "",
            items: [
               { text: "Público" },
               { text: "Seguidores" },
               { text: "Solo yo" }
            ]
         }
      },

      methods: {

         submit(){

         },

         limpiarCampos(){

         }
      }
   }

</script>
