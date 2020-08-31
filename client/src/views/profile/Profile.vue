
<template>

   <v-container class="ma-0 pa-0">
      <left-bar class="grey lighten-4" :cardUserData="cardUserData"/>
      <right-bar class="grey lighten-4" @post-created="catchPostCreated($event)"/>

      <div class="mx-2">

         <v-tabs icons-and-text grow v-model="tab" background-color="transparent" color="blue lighten-1">

            <v-tab class="text-capitalize" v-ripple="false" v-for="tab of tabs" :key="tab.id" :to="tab.route" exact>
               {{ tab.name }}
               <v-icon>{{ tab.icon }}</v-icon>
            </v-tab>

            <v-tab-item v-for="tab of tabs" :key="tab.id" :value="tab.route">
               <router-view :key="$route.path" :newPost="post"/>
            </v-tab-item>

         </v-tabs>

      </div>
   </v-container>

</template>

<script>

   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      components: {
         RightBar,
         LeftBar
      },

      data(){
         return {
            tab: null,
            post: {},
            username: "",
            tabs: [
               { id: 1, name: "Publicaciones", route: "publicaciones", icon: "mdi-post-outline"},
               { id: 2, name: "Seguidores", route: "seguidores", icon: "mdi-account-arrow-right-outline"},
               { id: 3, name: "Seguidos", route: "seguidos", icon: "mdi-account-arrow-left-outline"},
               { id: 4, name: "Me gusta", route: "me_gusta", icon: "mdi-thumb-up-outline"}
            ],
            cardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""},
            emptyCardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""},
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      mounted(){
         this.init(this.$route.params.username);
      },

      beforeRouteUpdate(to, from, next){
         if(this.$route.matched.some(route => route.name == "profile")){
            if(from.params.username != to.params.username){
               this.posts = [];
               this.currentPage = 0;
               this.cardUserData = this.emptyCardUserData;
               this.init(to.params.username);
            }
            next();
         }
      },

      methods: {

         async init(username){

            this.username = username;
            let response;

            try{
               if(this.authenticated){
                  if(this.username === this.user.username){
                     this.cardUserData = this.user;
                  }else{
                     response = await axios.get("public_user_data/" + this.username);
                     this.cardUserData = response.data;
                  }
               }else{
                  response = await axios.get("public_user_data/" + this.username);
                  this.cardUserData = response.data;
               }
            }catch(error){
               console.log(error);
            }
         },

         catchPostCreated(post){
            this.post = post;
         }
      }
   }

</script>
