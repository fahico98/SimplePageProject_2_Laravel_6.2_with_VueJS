
<template>

   <div>

      <v-container fluid>
         <v-row>
            {{ talks }}
         </v-row>
      </v-container>

   </div>

</template>

<script>

   import axios from "axios";
   import { mapGetters } from "vuex";

   export default {

      data(){
         return {
            talks: []
         }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),
      },

      mounted(){
         axios.get("messages/index").
            then((response) => {
               if(response.data){
                  console.log(response.data);
                  this.talks = response.data;
               }
            })
            .catch((error) => {
               console.log(error);
            });
      }
   }

</script>
