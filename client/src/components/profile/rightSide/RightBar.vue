
<template>

   <v-navigation-drawer width="25%" right permanent clipped app light>
      <div>
         <v-container fluid class="ma-0 pa-0">
            <v-row justify="center" align="center">
               <user-options-card @post-created="postCreated($event)"/>
            </v-row>
         </v-container>
      </div>
   </v-navigation-drawer>

</template>

<script>

   import UserOptionsCard from "./UserOptionsCard";

   export default {

      components: {
         UserOptionsCard
      },

      methods: {
         postCreated(post){
            this.$emit("post-created", post);
         }
      }
   }

</script>
