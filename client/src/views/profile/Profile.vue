
<template>

   <v-container class="ma-0 pa-0">

      <!-- <div>
         <v-btn text color="blue lighten-1" class="text-capitalize" v-ripple="false">
            <v-icon left>mdi-plus-circle-outline</v-icon> Agregar post
         </v-btn>
      </div> -->

      <profile-post-card v-for="post in posts" :key="post.id" :post="post"/>

   </v-container>

</template>

<script>

   import ProfilePostCard from "../../components/profile/ProfilePostCard";
   import { mapGetters, mapActions } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            posts: [],
            currentPage: 0,
            publicUserData: false,
            bottom: false
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

      watch: {
         bottom(bottom){
            if(bottom){ this.addPosts(); }
         }
      },

      created(){

         if(this.authenticated){
            this.publicUserData = (this.username === this.user.username) ?
               this.user :
               this.publicUserDataAction(this.username);
         }else{
            this.publicUserData = this.publicUserDataAction(this.username);
         }

         window.addEventListener('scroll', () => {
            this.bottom = this.bottomVisible()
         });

         this.addPosts();
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
            this.currentPage++;
            axios.get("posts/index/" + this.currentPage + "/" + this.username)
               .then((response) => {
                  this.posts = this.posts.concat(response.data);
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         ...mapActions({
            publicUserDataAction: "auth/publicUserDataAction"
         }),
      }
   }

</script>
