
<template>

   <v-row>
      <v-col>

         <v-card class="mx-auto" width="100%">
            <v-img :src="postImageUrl(post.post_picture)" width="100%"></v-img>

            <v-card-title>
               <div @click.prevent="goToProfile(post.user.username)">
                  <span class="black--text">{{ post.user.name }} {{ post.user.lastname }}&nbsp;</span>
                  <span class="font-weight-light grey--text">{{ post.user.username }}</span>
               </div>
            </v-card-title>

            <v-card-subtitle class="pt-2 black--text">
               <span class="body-1 font-weight-bold">{{ post.title }}: </span>{{ post.content }}
            </v-card-subtitle>

            <v-card-actions>

               <v-btn icon :color=" like ? 'red darken-4' : ''" @click.prevent="like()">
                  <v-icon>mdi-thumb-up</v-icon>
               </v-btn>
               <v-btn icon :color=" dislike ? 'green darken-1' : ''" @click.prevent="dislike()">
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
         })
      },

      methods: {

         postImageUrl(post_picture){
            return axios.defaults.baseURL.replace("/api", "") + post_picture;
         },

         checkLike(){
            axios.post("posts/check_like/" + this.post.id + "/" + this.user.id)
               .then((response) => {
                  console.log(response);
                  // this.I_like = response.data;
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         checkDislike(){
            axios.post("posts/check_dislike/" + this.post.id + "/" + this.user.id)
               .then((response) => {
                  console.log(response);
                  // this.I_dislike = response.data;
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         like(){
            axios.post("post/like/" + this.post.id + "/" + this.user.id)
               .then(() => {
                  if(!this.I_like){
                     this.I_like = true;
                     if(this.I_dislike){ this.I_dislike = false; }
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         dislike(){
            axios.post("post/dislike/" + this.post.id + "/" + this.user.id)
               .then(() => {
                  if(!this.I_dislike){
                     this.I_dislike = true;
                     if(this.I_like){ this.I_like = false; }
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         goToProfile(username){
            this.$router.push({name: "profile", params: {username: username}});
         },
      },

      mounted(){
         this.checkLike();
         this.checkDislike();
      }
   }

</script>
