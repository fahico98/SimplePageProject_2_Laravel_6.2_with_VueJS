
<template>

   <div class="home">
      <v-container fluid>
         <index-carousel/>
         <v-divider class="my-16"></v-divider>
         <mesh-cards/>
         <v-divider class="my-16"></v-divider>
         <testimonials-carousel/>
      </v-container>
   </div>

</template>

<script>

   import IndexCarousel from "../components/home/IndexCarousel";
   import MeshCards from "../components/home/MeshCards";
   import TestimonialsCarousel from "../components/home/TestimonialsCarousel";

   export default {

      name: 'Home',

      components: {
         IndexCarousel,
         MeshCards,
         TestimonialsCarousel
      }
   }

</script>
