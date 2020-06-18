
<template>

   <v-container class="ma-0 pa-0">

      <profile-post-card v-for="post in posts" :key="post.id" :post="post"/>

   </v-container>

</template>

<script>

   import ProfilePostCard from "../../components/profile/ProfilePostCard";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            posts: []
         }
      },

      props: [
         "username"
      ],

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      components: {
         ProfilePostCard
      },

      mounted(){
         axios.post("posts/index/" + this.username)
            .then((response) => {
               this.posts = response.data;
            })
            .catch((error) => {
               console.log(error);
            });
      }
   }

</script>
