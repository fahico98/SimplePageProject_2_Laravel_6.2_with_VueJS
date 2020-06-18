
<template>

   <v-navigation-drawer :floating="!inProfile()" width="25%" right permanent clipped app light>
      Hello world...!
   </v-navigation-drawer>

</template>

<script>

   export default {

      methods: {
         inProfile(){
            return this.$route.name == "profile";
         }
      }

   }

</script>
