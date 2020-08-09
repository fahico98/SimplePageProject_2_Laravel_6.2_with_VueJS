
<template>

   <div class="grey lighten-4">

      {{ followers }}

      <!-- <v-list subheader>

      </v-list> -->

      <infinite-loading @infinite="addUsers">

         <template v-slot:no-more>
            <p></p>
         </template>

         <template v-slot:no-results>
            <p class="blue--text text--lighten-1 mt-10" v-if="profileOwner">Aún no tienes seguidores !</p>
            <p class="blue--text text--lighten-1 mt-10" v-else>Este usuarios no tiene seguidores !</p>
         </template>

      </infinite-loading>

   </div>

</template>

<script>

   import InfiniteLoading from 'vue-infinite-loading';
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            followers: [],
            currentPage: 0,
            username: ""
         }
      },

      components: {
         InfiniteLoading
      },

      mounted(){
         this.username = this.$route.params.username;
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         profileOwner(){
            return this.authenticated ? this.username === this.user.username : false;
         }
      },

      methods: {

         async addUsers($state){

            this.currentPage++;

            // let url = this.$route.matched.some(route => route.name == "profile")
            //    ? "followers/" + this.currentPage + "/" + this.username
            //    : "posts/index/" + this.currentPage;

            await axios.get("followers/" + this.username + "/" + this.currentPage)
               .then((response) => {

                  if(response.data.length){
                     this.followers = this.followers.concat(response.data);
                     $state.loaded();
                     if(response.data.length < 20){
                        $state.complete();
                     }
                  }else{
                     $state.complete();
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         }
      }
   }

</script>
