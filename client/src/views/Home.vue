
<template>

   <div class="home">
      <v-container fluid>
         <index-carousel/>
      </v-container>
   </div>

</template>

<script>

   import IndexCarousel from "../components/animations/IndexCarousel";

   export default {

      name: 'Home',

      components: {
         IndexCarousel
      }

   }

</script>
