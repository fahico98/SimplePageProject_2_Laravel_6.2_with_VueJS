
<template>

   <div>

      <v-divider v-if="follower.divider" class="my-2"></v-divider>

      <v-list-item v-else>

         <v-list-item-avatar @click.prevent="goToProfile()" style="cursor: pointer">
            <v-img :src="correctedImageUrl"></v-img>
          </v-list-item-avatar>

         <v-list-item-content>

            <v-list-item-title>
               <span @click.prevent="goToProfile()" style="cursor: pointer">{{ completeName }}</span>
            </v-list-item-title>

            <v-list-item-subtitle>
               <span @click.prevent="goToProfile()" style="cursor: pointer">{{ follower.username }}</span>
            </v-list-item-subtitle>

         </v-list-item-content>

         <v-list-item-action v-if="this.follower.username != this.user.username">

            <v-btn small text width="100px" :dark="!follower.following" :light="follower.following" class="text-capitalize"
               v-ripple="false" :color="follower.following ? 'gray lighten-4' : 'blue lighten-1'"
               @click.prevent="followUnfollow()">
               {{ follower.following ? 'Siguiendo' : 'Seguir' }}
            </v-btn>

         </v-list-item-action>

      </v-list-item>

   </div>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            followingSatate: true
         }
      },

      props: {
         follower: {
            type: Object
         }
      },

      computed: {

         ...mapGetters({
            user: "auth/user",
            authenticated: "auth/authenticated"
         }),

         completeName(){
            return this.follower.name + " " + this.follower.lastname;
         },

         correctedImageUrl(){
            return this.follower.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") +
                  this.follower.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         }
      },

      methods: {

         goToProfile(){
            this.$router.push({name: "posts", params: {username: this.follower.username}});
         },

         followUnfollow(){
            if(this.authenticated){

               if(this.follower.following){

                  axios.delete("unfollow/" + this.follower.username)
                     .catch((error) => {
                        console.log(error);
                     });

               }else{

                  axios.post("follow/" + this.follower.username)
                     .catch((error) => {
                        console.log(error);
                     });

               }

               this.follower.following = !this.follower.following;
            }
         }
      }
   }

</script>
