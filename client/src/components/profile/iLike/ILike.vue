
<template>

   <div class="grey lighten-4">

      <div v-if="posts.length">
         <post-card v-for="post in posts" :key="post.id" :post="post"/>
      </div>

      <infinite-loading @infinite="addPosts">

         <template v-slot:no-more>
            <p class="blue--text text--lighten-1 my-6">No hay mas publicacioines !</p>
         </template>

         <template v-slot:no-results>
            <p class="blue--text text--lighten-1 mt-10" v-if="profileOwner">Aún no hay publicaciones que te gusten !</p>
            <p class="blue--text text--lighten-1 mt-10" v-else>Este usuarios no tiene publicaciones que le gusten !</p>
         </template>

      </infinite-loading>

   </div>

</template>

<script>

   import InfiniteLoading from 'vue-infinite-loading';
   import PostCard from "../posts/PostCard";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            posts: [],
            username: "",
            currentPage: 0
         }
      },

      components: {
         InfiniteLoading,
         PostCard
      },

      mounted(){
         this.username = this.$route.params.username;
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         profileOwner(){
            return this.authenticated ? this.username === this.user.username : false;
         }
      },

      methods: {

         async addPosts($state){

            this.currentPage++;

            await axios.get(`posts/liked_posts/${this.username}/${this.currentPage}`)
               .then((response) => {
                  if(response.data.length){
                     this.posts = this.posts.concat(response.data);
                     $state.loaded();
                     if(response.data.length < 5){
                        $state.complete();
                     }
                  }else{
                     $state.complete();
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         }
      }
   }

</script>
