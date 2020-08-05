
<template>

   <v-navigation-drawer width="25%" right permanent clipped app light>
   <!-- <v-navigation-drawer width="25%" permanent clipped app light> -->
      <div>
         <v-container fluid>
            <v-row justify="center" align="center">
               <profile-user-options-card/>
            </v-row>
         </v-container>
      </div>
   </v-navigation-drawer>

</template>

<script>

   import ProfileUserOptionsCard from "./ProfileUserOptionsCard";

   export default {

      components: {
         ProfileUserOptionsCard
      }
   }

</script>
