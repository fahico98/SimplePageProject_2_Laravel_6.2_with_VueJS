
<template>

   <v-container class="ma-0 pa-0">

      <!-- <div>
         <v-btn text color="blue lighten-1" class="text-capitalize" v-ripple="false">
            <v-icon left>mdi-plus-circle-outline</v-icon> Agregar post
         </v-btn>
      </div> -->

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
            publicUserData: null,
            emptyMessage: ""
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

         let response;

         try{
            if(this.authenticated){
               if(this.username === this.user.username){
                  this.publicUserData = this.user;
               }else{
                  response = await axios.get("auth/public_user_data/" + this.username);
                  this.publicUserData = response.data;
               }
            }else{
               response = await axios.get("auth/public_user_data/" + this.username);
               this.publicUserData = response.data;
            }
         }catch(error){
            console.log(error);
         }

         this.$emit("publicUserData", this.publicUserData);

         window.addEventListener('scroll', () => {
            this.bottom = this.bottomVisible()
         });

         // this.addPosts();
      },

      methods: {

         bottomVisible() {
            const scrollY = window.scrollY;
            const visible = document.documentElement.clientHeight;
            const pageHeight = document.documentElement.scrollHeight;
            const bottomOfPage = visible + scrollY >= pageHeight;
            return bottomOfPage || (pageHeight < visible);
         },

         addPosts(){
            if(this.publicUserData){
               this.currentPage++;
               axios.get("posts/index/" + this.currentPage + "/" + this.publicUserData.username)
                  .then((response) => {
                     this.posts = this.posts.concat(response.data);
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         }
      }
   }

</script>
