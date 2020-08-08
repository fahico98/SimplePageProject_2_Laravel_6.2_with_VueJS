
<template>

   <v-navigation-drawer width="25%" right permanent clipped app light>
      <div>
         <v-container fluid>
            <v-row justify="center" align="center">
               <user-options-card/>
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
      }
   }

</script>
