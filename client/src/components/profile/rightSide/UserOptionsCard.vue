
<template>

   <v-container class="my-0 px-8">

      <v-list flat dense>

         <edit-create-post-modal-form v-if="authenticated" action="create"/>

         <v-divider></v-divider>

         <v-list-item-group class="my-3">

            <v-list-item class="mx-0 px-0" :ripple="false" v-for="element in elements" :key="element.name" @click.prevent="">

               <v-btn depressed text :ripple="false" color="blue lighten-1" width="100%">
                  <p class="pa-0 ma-0 mr-auto" width="100%">
                     <v-icon left class="mr-4">{{ element.icon }}</v-icon>
                     <span class="subtitle-2 text-capitalize">{{ element.name }}</span>
                  </p>
               </v-btn>

            </v-list-item>

         </v-list-item-group>

         <!-- <v-list-item-group class="my-3" color="primary">

            <v-list-item :ripple="false" @click.prevent="" v-for="element in elements" :key="element.name">

               <v-list-item-icon>
                  <v-icon class="mr-2">{{ element.icon }}</v-icon>
               </v-list-item-icon>

               <v-list-item-content>
                  <v-list-item-title>
                     <span class="subtitle-2 text-capitalize">{{ element.name }}</span>
                  </v-list-item-title>
               </v-list-item-content>

            </v-list-item>

         </v-list-item-group> -->

         <v-divider></v-divider>

      </v-list>

   </v-container>

</template>

<script>

   import EditCreatePostModalForm from "../modals/EditCreatePostModalForm";
   import { mapGetters } from "vuex";

   export default {

      data(){
         return {
            elements: [
               { name: "inicio", icon: "mdi-home"},
               { name: "mensajes", icon: "mdi-email"},
               { name: "configuración", icon: "mdi-cog"},
               { name: "cerrar sesión", icon: "mdi-logout"}
            ]
         }
      },

      computed: {
         ...mapGetters({
               authenticated: "auth/authenticated",
               //user: "auth/user"
            }),
      },

      components: {
         EditCreatePostModalForm
      }
   }

</script>
