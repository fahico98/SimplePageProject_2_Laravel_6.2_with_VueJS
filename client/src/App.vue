
<template>

   <v-app>
      <main-app-bar/>

      <v-main class="grey lighten-4">
         <div><router-view :key="$route.path"/></div>
      </v-main>

      <main-footer v-if="footerPermission()"/>
   </v-app>

</template>

<script>

   import MainAppBar from "./components/MainAppBar";
   import MainFooter from "./components/MainFooter";

   export default {

      name: 'App',

      data(){
         return {
            noFooterRoutes: [
               "profile",
               "auth_home",
               "messages",
               "settings"
            ]
         }
      },

      components: {
         MainAppBar,
         MainFooter
      },

      methods: {

         footerPermission(){
            for(var i = 0; i < this.noFooterRoutes.length; i++){
               for(var j = 0; j < this.$route.matched.length; j++){
                  if(this.noFooterRoutes[i] == this.$route.matched[j].name){
                     return false;
                  }
               }
            }
            return true;
         }
      }
   };

</script>
