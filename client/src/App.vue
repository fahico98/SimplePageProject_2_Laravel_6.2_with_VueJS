
<template>

   <v-app>

      <main-app-bar/>

      <v-container class="mt-12">
         <router-view></router-view>
      </v-container>

   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";

   export default {

      name: 'App',

      components: {
         MainAppBar
      },

      data(){
         return {

         }
      },

   };

</script>
