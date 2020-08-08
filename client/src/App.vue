
<template>

   <v-app>
      <main-app-bar/>

      <v-main class="grey lighten-4">
         <div><router-view :key="$route.path"/></div>
      </v-main>

      <main-footer v-if="$route.matched.every(route => route.name != 'profile') && $route.name != 'auth_home'"/>
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
