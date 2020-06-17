
<template>

   <v-container class="ma-0 pa-0">

      <v-row v-for="post in posts" :key="post.id">
         <v-col>
            <v-card class="mx-auto" width="100%">
               <v-img :src="postImageUrl(post.post_picture)" width="100%"></v-img>

               <v-card-title>{{ post.title }}</v-card-title>

               <v-card-subtitle>{{ post.content }}</v-card-subtitle>

               <v-card-actions>
                  <v-btn text>Like</v-btn>
                  <v-btn color="purple" text>Dislike</v-btn>

                  <v-spacer></v-spacer>

                  <v-btn icon>
                     <v-icon>{{ 'mdi-chevron-down' /*show ? 'mdi-chevron-up' : 'mdi-chevron-down'*/ }}</v-icon>
                  </v-btn>
               </v-card-actions>
            </v-card>
         </v-col>
      </v-row>

   </v-container>

</template>

<script>

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

      components: {

      },

      computed: {
         ...mapGetters({
            user: "auth/user",
            authenticated: "auth/authenticated"
         })
      },

      mounted(){
         axios.post("posts/index/" + this.username)
            .then((response) => {
               this.posts = response.data;
            })
            .catch((error) => {
               console.log(error);
            });
      },

      methods: {
         postImageUrl(post_picture){
            return axios.defaults.baseURL.replace("/api", "") + post_picture;
         },
      }
   }

</script>
