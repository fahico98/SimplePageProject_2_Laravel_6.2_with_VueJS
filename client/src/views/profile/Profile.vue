
<template>

   <v-container class="ma-0 pa-0">

      <profile-left-bar class="grey lighten-4" :cardUserData="cardUserData"/>
      <profile-right-bar class="grey lighten-4"/>

      <div class="mx-2" v-if="!emptyPostsArray">
         <profile-post-card v-for="post in posts" :key="post.id" :post="post"></profile-post-card>
      </div>

   </v-container>

</template>

<script>

   import ProfilePostCard from "../../components/profile/ProfilePostCard";
   import ProfileLeftBar from "../../components/profile/ProfileLeftBar";
   import ProfileRightBar from "../../components/profile/ProfileRightBar";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            posts: [],
            currentPage: 0,
            bottom: false,
            username: "",
            cardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""},
            emptyCardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""}
         }
      },

      components: {
         ProfilePostCard,
         ProfileLeftBar,
         ProfileRightBar
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         emptyPostsArray(){
            return this.posts.length == 0;
         }
      },

      watch: {
         bottom(bottom){
            if(bottom){ this.addPosts(); }
         }
      },

      mounted(){
         this.init(this.$route.params.username);
      },

      beforeRouteUpdate(to, from, next){
         this.posts = [];
         this.currentPage = 0;
         this.cardUserData = this.emptyCardUserData;
         this.init(to.params.username);
         next();
      },

      methods: {

         async init(username){

            if(this.$route.name == "profile"){

               this.username = username;
               let response;

               try{
                  if(this.authenticated){
                     if(this.username === this.user.username){
                        this.cardUserData = this.user;
                     }else{
                        response = await axios.get("public_user_data/" + this.username);
                        this.cardUserData = response.data;
                        this.correctImageUrl();
                     }
                  }else{
                     response = await axios.get("public_user_data/" + this.username);
                     this.cardUserData = response.data;
                     this.correctImageUrl();
                  }
               }catch(error){
                  console.log(error);
               }
            }

            window.addEventListener('scroll', () => {
               this.bottom = this.bottomVisible()
            });

            this.addPosts();
         },

         correctImageUrl(){
            if(this.cardUserData.profile_picture){
               this.cardUserData.profile_picture.url = axios.defaults.baseURL.replace("/api", "") +
                  this.cardUserData.profile_picture.url.replace("public/", "storage/");
            }else{
               this.cardUserData.profile_picture = {
                  url: axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg",
                  size: 5229
               };
            }
         },

         bottomVisible(){
            const scrollY = window.scrollY;
            const visible = document.documentElement.clientHeight;
            const pageHeight = document.documentElement.scrollHeight;
            const bottomOfPage = visible + scrollY >= pageHeight;
            return bottomOfPage || (pageHeight < visible);
         },

         async addPosts(){

            this.currentPage++;

            let url = this.$route.name == "profile"
               ? "posts/index/" + this.currentPage + "/" + this.username
               : "posts/index/" + this.currentPage;

            await axios.get(url)
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
