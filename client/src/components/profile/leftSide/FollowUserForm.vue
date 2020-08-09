
<template>

   <v-container fluid class="ma-0 pa-0">

      <v-btn small depressed width="100%" class="text-capitalize" :dark="!following" :light="following" v-ripple="false"
         :color="following ? 'grey lighten-1' : 'blue lighten-1'" @click.prevent="followUnfollow()">
         {{ following ? "Dejar de seguir" : "Seguir" }}
      </v-btn>

   </v-container>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {

         }
      },

      props: {
         username: {
            type: String,
            // required: true
         },
         following: {
            type: Boolean,
            // required: true
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      methods: {

         followUnfollow(){
            if(this.authenticated){

               this.$emit("changeFollowingState");

               if(this.following){

                  axios.delete("unfollow/" + this.username)
                     .then((response) => {
                        console.log(response.data);
                     })
                     .catch((error) => {
                        console.log(error);
                     });

               }else{

                  axios.post("follow/" + this.username)
                     .then((response) => {
                        console.log(response.data);
                     })
                     .catch((error) => {
                        console.log(error);
                     });

               }
            }
         }
      }
   }
</script>
