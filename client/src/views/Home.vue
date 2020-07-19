
<template>

   <div class="home">
      <v-container fluid>
         <index-carousel/>
         <v-divider class="my-16"></v-divider>
         <mesh-cards/>
         <v-divider class="my-16"></v-divider>
      </v-container>
   </div>

</template>

<script>

   import IndexCarousel from "../components/animations/IndexCarousel";
   import MeshCards from "../components/MeshCards";

   export default {

      name: 'Home',

      components: {
         IndexCarousel,
         MeshCards
      }

   }

</script>
