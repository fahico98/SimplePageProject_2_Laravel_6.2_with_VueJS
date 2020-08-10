
<template>

   <div class="grey lighten-4 mt-5">

      <user-list-element v-for="listUser in userList" :key="listUser.username" :listUser="listUser"/>

      <infinite-loading @infinite="addUsers">

         <template v-slot:no-more><p></p></template>

         <template v-slot:no-results>
            <p class="blue--text text--lighten-1 mt-10" v-if="profileOwner">Aún no tienes seguidores !</p>
            <p class="blue--text text--lighten-1 mt-10" v-else>Este usuarios no tiene seguidores !</p>
         </template>

      </infinite-loading>

   </div>

</template>

<script>

   import UserListElement from "./UserListElement";
   import InfiniteLoading from 'vue-infinite-loading';
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            userList: [],
            currentPage: 0,
            username: "",
            url: "",
         }
      },

      components: {
         InfiniteLoading,
         UserListElement
      },

      mounted(){
         this.url = this.$route.matched.some(route => route.name == "followers") ? "followers" : "followed";
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

            await axios.get(`followers_followed/${this.username}/${this.url}/${this.currentPage}`)
               .then((response) => {

                  if(response.data.length){

                     if(this.userList.length){
                        this.userList = this.userList.concat({divider: true});
                     }

                     for(let i = 0; i < response.data.length; i++){
                        this.userList = this.userList.concat(response.data[i]);
                        if(i != response.data.length - 1){
                           this.userList = this.userList.concat({divider: true});
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
