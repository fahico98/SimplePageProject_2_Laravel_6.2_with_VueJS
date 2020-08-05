
<template>

   <v-app>
      <main-app-bar/>

      <v-main class="grey lighten-4">
         <div><router-view/></div>
      </v-main>

      <main-footer v-if="$route.name != 'profile'"/>
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
      }
   };

</script>
