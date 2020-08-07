
<template>

   <v-container class="my-0 px-8">
      <edit-create-post-modal-form v-if="authenticated" action="create"/>
   </v-container>

</template>

<script>

   import EditCreatePostModalForm from "./modals/EditCreatePostModalForm";
   import { mapGetters } from "vuex";

   export default {

      computed: {
         ...mapGetters({
               authenticated: "auth/authenticated",
               //user: "auth/user"
            }),
      },

      components: {
         EditCreatePostModalForm
      }
   }

</script>
