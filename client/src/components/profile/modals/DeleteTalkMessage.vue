
<template>

   <div style="display: inline">
      <v-dialog v-model="dialog" max-width="450px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn icon text small color="blue lighten-1" class="ma-0" v-bind="attrs" v-on="on" v-ripple="action == 'message'">
               <v-icon small :title="title">mdi-close</v-icon>
            </v-btn>
         </template>

         <v-card>

            <v-card-title class="headline pt-5">{{ title }}</v-card-title>

            <v-form class="mt-4 pa-0" @submit.prevent="">

               <p class="px-6">{{ cardBody }}</p>

               <v-card-actions>

                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" v-ripple="false"
                     color="blue lighten-1">
                     <span class="px-2">Eliminar</span>
                  </v-btn>

                  <v-btn depressed outlined @click="dialog = false" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                     <span class="px-2">Cancelar</span>
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>

      </v-dialog>

   </div>

</template>

<script>

   export default {

      data(){
         return {
            dialog: false
         }
      },

      computed: {

         title(){
            return this.action == "message"
               ? "Eliminar mensaje"
               : "Eliminar conversación";
         },

         cardBody(){
            return this.action == "message"
               ? "Esta seguro que desea eliminar esta mensaje ? Si lo eliminar se perdera para siempre, no podrá recuperarlo."
               : "Si elimina esta conversación no podrá recuperar los mensajes de la misma...";
         }
      },

      props: {
         action: {
            type: String,
            required: true
         }
      },

      methods: {
         submit(){
            this.dialog = false;
            this.$emit("eventTriggered");
         }
      }
   }

</script>
