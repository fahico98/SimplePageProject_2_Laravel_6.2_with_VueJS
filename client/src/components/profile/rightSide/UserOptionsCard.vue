
<template>

   <v-container class="my-0 px-8">
      <v-list flat dense>

         <edit-create-post-modal-form v-if="authenticated" action="create"/>

         <v-divider></v-divider>

         <v-list-item-group class="my-3">
            <v-list-item class="mx-0 px-0" :ripple="false" v-for="element in elements" :key="element.name" @click.prevent="">

               <v-btn depressed text :ripple="false" color="blue lighten-1" width="100%" @click.prevent="element.click()">
                  <p class="pa-0 ma-0 mr-auto" width="100%">
                     <v-icon left class="mr-4">{{ element.icon }}</v-icon>
                     <span class="subtitle-2 text-capitalize">{{ element.name }}</span>
                  </p>
               </v-btn>

            </v-list-item>
         </v-list-item-group>

         <v-divider></v-divider>

      </v-list>
   </v-container>

</template>

<script>

   import EditCreatePostModalForm from "../modals/EditCreatePostModalForm";
   import { mapActions, mapGetters } from "vuex";

   export default {

      data(){
         return {
            elements: [
               { name: "inicio", icon: "mdi-home", click: this.home},
               { name: "mensajes", icon: "mdi-email", click: this.logout},
               { name: "configuración", icon: "mdi-cog", click: this.logout},
               { name: "cerrar sesión", icon: "mdi-logout", click: this.logout}
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
      },

      methods: {

         ...mapActions({
            logoutAction: "auth/logoutAction"
         }),

         logout(){
            this.logoutAction()
               .then(() => {
                  this.$router.push({name: "login"});
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         home(){
            this.$router.push({name: "auth_home"});
         }
      }
   }

</script>
