
<template>

   <div>
      <h1>Perfil de {{ user.name }}&nbsp;{{ user.lastname }}.</h1>
   </div>

</template>

<script>

   import { mapGetters } from "vuex";

   export default {

      computed: {
         ...mapGetters({
            user: "auth/user"
         })
      }
   }

</script>
