
<template>

   <div>
      <v-btn text dark v-ripple="false" v-on:click="goTo('home')" class="text-capitalize mr-2">inicio</v-btn>
      <v-btn text dark v-ripple="false" v-on:click="goTo('register')" class="text-capitalize mr-2">registro</v-btn>
      <v-btn text dark v-ripple="false" v-on:click="goTo('login')" class="text-capitalize mr-2">iniciar sesion</v-btn>
   </div>

</template>

<script>

   export default {

      methods: {
         goTo(routeName){
            this.$router.push({name: routeName});
         }
      }
   }

</script>
