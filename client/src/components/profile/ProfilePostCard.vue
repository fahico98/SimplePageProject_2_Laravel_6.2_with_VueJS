
<template>

   <v-row>
      <v-col>

         <v-card class="mx-auto" width="100%">

            <v-carousel :hide-delimiter-background="hideDelimiters" :hide-delimiters="hideDelimiters" :continuous="false"
               :show-arrows="false" height="100%" delimiter-icon="mdi-circle">

               <v-carousel-item v-for="image in post.images" :key="image.url">
                  <v-img :src="image.url"></v-img>
               </v-carousel-item>

            </v-carousel>

            <v-card-title>
               <div @click.prevent="goToProfile(post.user.username)">
                  <span class="black--text">{{ post.user.name }} {{ post.user.lastname }}&nbsp;</span>
                  <span class="font-weight-light grey--text">{{ post.user.username }}</span>
               </div>
            </v-card-title>

            <v-card-subtitle class="pt-2 black--text">
               <span class="body-1 font-weight-bold">{{ post.title }}</span>&nbsp;{{ post.content }}
            </v-card-subtitle>

            <v-card-actions>

               <v-btn icon :color="I_like ? 'green darken-1' : 'grey'" @click.prevent="like()">
                  <v-icon>mdi-thumb-up</v-icon>
               </v-btn>
               <v-btn icon :color="I_dislike ? 'red darken-4' : 'grey'" @click.prevent="dislike()">
                  <v-icon>mdi-thumb-down</v-icon>
               </v-btn>

               <v-spacer></v-spacer>

               <v-btn icon>
                  <v-icon>{{ 'mdi-chevron-down' /*show ? 'mdi-chevron-up' : 'mdi-chevron-down'*/ }}</v-icon>
               </v-btn>

            </v-card-actions>
         </v-card>

      </v-col>
   </v-row>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            I_like: false,
            I_dislike: false
         }
      },

      props: [
         "post"
      ],

      computed: {

         ...mapGetters({
            // authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         hideDelimiters(){
            return this.post.images.length <= 1;
         }
      },

      mounted(){

         this.checkLike();
         if(!this.I_like){ this.checkDislike(); }

         this.post.images.forEach((image) => {
            image.url = axios.defaults.baseURL.replace("/api", "") + image.url.replace("public/", "storage/");
         });

         //this.correctImagesUrls();
      },

      methods: {

         // postImageUrl(post_picture){
         //    return axios.defaults.baseURL.replace("/api", "") + post_picture.replace("public/", "storage/");
         // },

         // correctImagesUrls(){
         //    if(this.post.images.length != 0){
         //       this.post.images.forEach((image) => {
         //          image.url = axios.defaults.baseURL.replace("/api", "") + image.url;
         //       });
         //    }
         // },

         checkLike(){
            axios.get("posts/check_like/" + this.post.id + "/" + this.user.id)
               .then((response) => {
                  this.I_like = response.data;
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         checkDislike(){
            axios.get("posts/check_dislike/" + this.post.id + "/" + this.user.id)
               .then((response) => {
                  this.I_dislike = response.data;
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         like(){
            if(!this.I_like){
               this.I_like = true;
               if(this.I_dislike){ this.I_dislike = false; }
               axios.post("posts/like/" + this.post.id + "/" + this.I_like)
                  .catch((error) => {
                     console.log(error);
                  });
            }else{
               this.I_like = false;
               axios.post("posts/undo_like/" + this.post.id)
                  .catch((error) => {
                     console.log(error);
                  });
            }
         },

         dislike(){
            if(!this.I_dislike){
               this.I_dislike = true;
               if(this.I_like){ this.I_like = false; }
               axios.post("posts/dislike/" + this.post.id + "/" + this.I_dislike)
                  .catch((error) => {
                     console.log(error);
                  });
            }else{
               this.I_dislike = false;
               axios.post("posts/undo_dislike/" + this.post.id)
                  .catch((error) => {
                     console.log(error);
                  });
            }
         },

         goToProfile(username){
            this.$router.push({name: "profile", params: {username: username}});
         },
      }
   }

</script>
