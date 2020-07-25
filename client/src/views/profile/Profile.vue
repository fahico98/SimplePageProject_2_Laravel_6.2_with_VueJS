
<template>

   <v-container class="ma-0 pa-0">

      <div v-if="!emptyPostsArray">
         <profile-post-card v-for="post in posts" :key="post.id" :post="post"></profile-post-card>
      </div>

   </v-container>

</template>

<script>

   import ProfilePostCard from "../../components/profile/ProfilePostCard";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            posts: [],
            currentPage: 0,
            bottom: false,
            // loading: true
         }
      },

      props: [
         "username"
      ],

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         emptyPostsArray(){
            return this.posts.length == 0;
         }
      },

      components: {
         ProfilePostCard
      },

      watch: {
         bottom(bottom){
            if(bottom){ this.addPosts(); }
         }
      },

      async created(){

         window.addEventListener('scroll', () => {
            this.bottom = this.bottomVisible()
         });

         this.addPosts();
         // loading = false;
      },

      methods: {

         bottomVisible() {
            const scrollY = window.scrollY;
            const visible = document.documentElement.clientHeight;
            const pageHeight = document.documentElement.scrollHeight;
            const bottomOfPage = visible + scrollY >= pageHeight;
            return bottomOfPage || (pageHeight < visible);
         },

         async addPosts(){

            this.currentPage++;

            await axios.get("posts/index/" + this.currentPage + "/" + this.username)
               .then((response) => {
                  this.posts = this.posts.concat(response.data);
               })
               .catch((error) => {
                  console.log(error);
               });
         }
      }
   }

</script>
