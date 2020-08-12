
<template>

   <v-row class="pa-0 ma-0 mt-5">
      <v-col class="pa-0 ma-0">

         <v-card class="mx-auto" width="100%">

            <v-carousel :hide-delimiter-background="hideDelimiters" :hide-delimiters="hideDelimiters" :continuous="false"
               :show-arrows="false" height="100%" delimiter-icon="mdi-circle">

               <v-carousel-item v-for="image in post.images" :key="image.url">
                  <v-img :src="image.url"></v-img>
               </v-carousel-item>

            </v-carousel>

            <v-card-title>

               <div @click.prevent="goToProfile()" style="cursor: pointer">
                  <span class="black--text">{{ post.user.name }}&nbsp;{{ post.user.lastname }}&nbsp;</span>
                  <span class="font-weight-light grey--text">{{ post.user.username }}</span>
               </div>

               <v-spacer></v-spacer>

               <span class="caption font-weight-light grey--text">{{ post.created_at_for_humans }}</span>

            </v-card-title>


            <v-card-subtitle class="pt-2 black--text">
               <span class="body-1 font-weight-bold">{{ post.title }}</span>&nbsp;{{ post.content }}
            </v-card-subtitle>

            <v-card-actions>

               <v-btn icon v-ripple="false" :color="post.i_like ? 'blue lighten-1' : 'grey'" @click.prevent="like()">
                  <v-icon>{{ post.i_like ? 'mdi-thumb-up' : 'mdi-thumb-up-outline' }}</v-icon>
               </v-btn>
               <span class="text--grey">{{ post.likes }}</span>

               <v-btn icon v-ripple="false" :color="post.i_dislike ? 'blue lighten-1' : 'grey'" @click.prevent="dislike()"
                  class="ml-3">
                  <v-icon>{{ post.i_dislike ? 'mdi-thumb-down' : 'mdi-thumb-down-outline' }}</v-icon>
               </v-btn>
               <span color="grey">{{ post.dislikes }}</span>

               <v-spacer></v-spacer>

               <div v-if="profileOwner">

                  <edit-create-post-modal-form :post="post" action="edit"/>

                  <delete-post-modal-form :postId="post.id"/>

                  <v-chip small dark v-if="inProfile()" class="mx-2" color="blue lighten-1">
                     {{ permissionName }}
                  </v-chip>

               </div>

            </v-card-actions>
         </v-card>

      </v-col>
   </v-row>

</template>

<script>

   import EditCreatePostModalForm from "../modals/EditCreatePostModalForm";
   import DeletePostModalForm from "../modals/DeletePostModalForm";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      components: {
         EditCreatePostModalForm,
         DeletePostModalForm
      },

      props: {
         post: {type: Object}
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         profileOwner(){
            return this.authenticated ? this.user.username === this.post.user.username : false;
         },

         hideDelimiters(){
            return this.post.images.length <= 1;
         },

         permissionName(){
            if(this.post.post_permission.id == 1){
               return "Público";
            }else if(this.post.post_permission.id == 2){
               return "Seguidores";
            }else{
               return "Solo yo";
            }
         }
      },

      mounted(){
         this.post.images.forEach((image) => {
            image.url = axios.defaults.baseURL.replace("/api", "") + image.url.replace("public/", "storage/");
         });
      },

      methods: {

         like(){
            if(!this.post.i_like){
               axios.post("posts/like/" + this.post.id + "/" + this.post.i_dislike)
                  .catch((error) => {
                     console.log(error);
                  });
               this.addLike();
            }else{
               axios.post("posts/undo_like/" + this.post.id)
                  .catch((error) => {
                     console.log(error);
                  });
               this.post.i_like = false;
               this.post.likes--;
            }
         },

         dislike(){
            if(!this.post.i_dislike){
               axios.post("posts/dislike/" + this.post.id + "/" + this.post.i_like)
                  .catch((error) => {
                     console.log(error);
                  });
               this.addDislike();
            }else{
               axios.post("posts/undo_dislike/" + this.post.id)
                  .catch((error) => {
                     console.log(error);
                  });
               this.post.i_dislike = false;
               this.post.dislikes--;
            }
         },

         addLike(){
            if(this.post.i_dislike){
               this.post.i_dislike = false;
               this.post.dislikes--;
            }
            this.post.i_like = true;
            this.post.likes++;
         },

         addDislike(){
            if(this.post.i_like){
               this.post.i_like = false;
               this.post.likes--;
            }
            this.post.i_dislike = true;
            this.post.dislikes++;
         },

         goToProfile(){
            this.$router.push({name: "posts", params: {username: this.post.user.username}});
         },

         inProfile(){
            return this.$route.matched.some(route => route.name == "profile");
         }
      }
   }

</script>
