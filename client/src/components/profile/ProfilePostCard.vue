
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
               <div @click.prevent="goToProfile(post.user.username)" style="cursor: pointer">
                  <span class="black--text">{{ post.user.name }}&nbsp;{{ post.user.lastname }}&nbsp;</span>
                  <span class="font-weight-light grey--text">{{ post.user.username }}</span>
               </div>
            </v-card-title>

            <v-card-subtitle class="pt-2 black--text">
               <span class="body-1 font-weight-bold">{{ post.title }}</span>&nbsp;{{ post.content }}
            </v-card-subtitle>

            <v-card-actions>

               <v-btn icon :color="post.i_like ? 'green darken-1' : 'grey'" @click.prevent="like()">
                  <v-icon>mdi-thumb-up</v-icon>
               </v-btn>
               &nbsp;{{ post.likes }}

               <v-btn icon :color="post.i_dislike ? 'red darken-4' : 'grey'" @click.prevent="dislike()">
                  <v-icon>mdi-thumb-down</v-icon>
               </v-btn>
               &nbsp;{{ post.dislikes }}

               <v-btn icon v-if="profileOwner" color="grey" @click.prevent="">
                  <v-icon>mdi-delete</v-icon>
               </v-btn>

               <v-btn icon v-if="profileOwner" color="grey" @click.prevent="">
                  <v-icon>mdi-pencil</v-icon>
               </v-btn>

               <v-spacer></v-spacer>

               <v-btn v-if="profileOwner" icon>
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

         goToProfile(username){
            this.$router.push({name: "profile", params: {username: username}});
         },
      }
   }

</script>
