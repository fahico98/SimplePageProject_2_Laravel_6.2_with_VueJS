
<template>

   <v-app>

      <main-app-bar/>

      <v-container class="my-12">
         <router-view></router-view>
      </v-container>

      <main-footer/>

   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";
   import MainFooter from "./components/MainFooter";

   export default {

      name: 'App',

      components: {
         MainAppBar,
         MainFooter
      },

      data(){
         return {

         }
      }
   };

</script>
