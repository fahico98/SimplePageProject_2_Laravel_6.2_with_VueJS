
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="pa-0 ma-0 pr-3">
            <v-select outlined dense :items="items" v-model="post_permission_id" color="blue lighten-1" class="mt-1"
               label="Permiso por defecto">
            </v-select>
         </v-col>

      </v-row>

      <v-row class="ma-0 pa-0 mt-5">

         <v-btn dark depressed class="text-capitalize" color="blue lighten-1" @click.prevent="submit()">
            guardar cambios</v-btn>
         <v-btn dark outlined class="text-capitalize ml-2" color="blue lighten-1">
            restaurar</v-btn>

      </v-row>
   </v-container>

</template>

<script>

   export default {

      data(){
         return {
            post_permission_id: 1,
            items: [
               { value: 1, text: "Público" },
               { value: 2, text: "Seguidores" },
               { value: 3, text: "Solo yo" }
            ]
         }
      }
   }

</script>
