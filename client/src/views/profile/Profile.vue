
<template>

   <v-container class="ma-0 pa-0">

      <left-bar class="grey lighten-4" :cardUserData="cardUserData"/>
      <right-bar class="grey lighten-4"/>

      <div class="mx-2">

         <v-tabs grow v-model="tab" background-color="transparent" color="blue lighten-1">

            <!-- <v-tab class="text-capitalize" v-ripple="false" :to="'/publicaciones'" exact>Publicaciones</v-tab>
            <v-tab class="text-capitalize" v-ripple="false" :to="'/seguidores'" exact>Seguidores</v-tab>
            <v-tab class="text-capitalize" v-ripple="false" :to="'/seguidos'" exact>Seguidos</v-tab>
            <v-tab class="text-capitalize" v-ripple="false" :to="'/me_gusta'" exact>Me gusta</v-tab> -->

            <v-tab class="text-capitalize" v-ripple="false" v-for="tab of tabs" :key="tab.id" :to="tab.route" exact>
               {{ tab.name }}
            </v-tab>

            <v-tab-item v-for="tab of tabs" :key="tab.id" :value="tab.route">
               <router-view></router-view>
            </v-tab-item>

         </v-tabs>


         <!-- <v-tabs-items v-model="tab">

            <v-tab-item>
               <div class="grey lighten-4">
                  <profile-post-card v-for="post in posts" :key="post.id" :post="post"/>
               </div>
            </v-tab-item>

            <v-tab-item>
               <p class="text-h4 blue--text text--lighten-1">Publicaciones</p>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt ratione consectetur voluptates omnis placeat officiis similique. Culpa, obcaecati laboriosam vitae corrupti, porro in dolorum excepturi maxime voluptates rem voluptate id!</p>
            </v-tab-item>

            <v-tab-item>
               <p class="text-h4 blue--text text--lighten-1">Seguidores</p>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt ratione consectetur voluptates omnis placeat officiis similique. Culpa, obcaecati laboriosam vitae corrupti, porro in dolorum excepturi maxime voluptates rem voluptate id!</p>
            </v-tab-item>

            <v-tab-item>
               <p class="text-h4 blue--text text--lighten-1">Seguidos</p>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt ratione consectetur voluptates omnis placeat officiis similique. Culpa, obcaecati laboriosam vitae corrupti, porro in dolorum excepturi maxime voluptates rem voluptate id!</p>
            </v-tab-item>

            <v-tab-item>
               <p class="text-h4 blue--text text--lighten-1">Me gusta</p>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt ratione consectetur voluptates omnis placeat officiis similique. Culpa, obcaecati laboriosam vitae corrupti, porro in dolorum excepturi maxime voluptates rem voluptate id!</p>
            </v-tab-item>

         </v-tabs-items> -->

      </div>

   </v-container>

</template>

<script>

   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            tab: null,
            username: "",
            tabs: [
               { id: 1, name: "Publicaciones", route: "publicaciones" },
               { id: 2, name: "Seguidores", route: "seguidores" },
               { id: 3, name: "Seguidos", route: "seguidos" },
               { id: 4, name: "Me gusta", route: "me_gusta" }
            ],
            cardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""},
            emptyCardUserData: {username: "", name: "", lastname: "", country: "", city: "", phone_number: "", email: "",
               password: "", role_id: "", profile_picture: "", biography: ""}
         }
      },

      components: {
         RightBar,
         LeftBar
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),
      },

      mounted(){
         this.init(this.$route.params.username);
      },

      beforeRouteUpdate(to, from, next){
         if(from.params.username != to.params.username){
            this.posts = [];
            this.currentPage = 0;
            this.cardUserData = this.emptyCardUserData;
            this.init(to.params.username);
         }
         next();
      },

      methods: {

         async init(username){
            if(this.$route.matched.some(route => route.name == "profile")){
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
            }
         }

         // bottomVisible(){
         //    const scrollY = window.scrollY;
         //    const visible = document.documentElement.clientHeight;
         //    const pageHeight = document.documentElement.scrollHeight;
         //    const bottomOfPage = visible + scrollY >= pageHeight;
         //    return bottomOfPage || (pageHeight < visible);
         // },

         // async addPosts(){

         //    this.currentPage++;

         //    let url = this.$route.name == "profile"
         //       ? "posts/index/" + this.currentPage + "/" + this.username
         //       : "posts/index/" + this.currentPage;

         //    await axios.get(url)
         //       .then((response) => {
         //          this.posts = this.posts.concat(response.data);
         //       })
         //       .catch((error) => {
         //          console.log(error);
         //       });
         // }
      }
   }

</script>
