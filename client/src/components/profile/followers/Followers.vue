
<template>

   <div class="grey lighten-4 mt-5">

      <follower-list-element v-for="follower in followers" :key="follower.username" :follower="follower"/>

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

   import FollowerListElement from "./FollowerListElement";
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
         InfiniteLoading,
         FollowerListElement
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

            await axios.get("followers/" + this.username + "/" + this.currentPage)
               .then((response) => {

                  if(response.data.length){

                     if(this.followers.length){
                        this.followers = this.followers.concat({divider: true});
                     }

                     for(let i = 0; i < response.data.length; i++){
                        this.followers = this.followers.concat(response.data[i]);
                        if(i != response.data.length){
                           this.followers = this.followers.concat({divider: true});
                        }
                     }

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
