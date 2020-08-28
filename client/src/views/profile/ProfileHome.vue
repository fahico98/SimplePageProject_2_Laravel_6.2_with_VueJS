
<template>

   <v-container class="ma-0 pa-0">

      <left-bar class="grey lighten-4"/>
      <right-bar class="grey lighten-4" @post-created="catchPostCreated($event)"/>

      <div class="mx-2">
         <posts class="mx-1" :newPost="post"/>
      </div>

   </v-container>

</template>

<script>

   import Posts from "../../components/profile/posts/Posts";
   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import { mapGetters } from "vuex";
   // import axios from "axios";

   export default {

      data(){
         return {
            post: {}
         }
      },

      components: {
         RightBar,
         LeftBar,
         Posts
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      methods: {
         catchPostCreated(post){
            this.post = post;
         }
      }
   }

</script>
