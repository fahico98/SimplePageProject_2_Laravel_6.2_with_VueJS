
<template>

   <v-container class="my-0 px-12">
      <new-post-modal-form v-if="authenticated"/>
   </v-container>

</template>

<script>

   import NewPostModalForm from "./modals/NewPostModalForm";
   import { mapGetters } from "vuex";

   export default {

      computed: {
         ...mapGetters({
               authenticated: "auth/authenticated",
               //user: "auth/user"
            }),
      },

      components: {
         NewPostModalForm
      }
   }

</script>
