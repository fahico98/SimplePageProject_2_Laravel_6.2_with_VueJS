
<template>

   <div>

      <v-divider v-if="listUser.divider" class="my-2"></v-divider>

      <v-list-item v-else>

         <v-list-item-avatar @click.prevent="goToProfile()" style="cursor: pointer">
            <v-img :src="correctedImageUrl"></v-img>
          </v-list-item-avatar>

         <v-list-item-content>

            <v-list-item-title>
               <span @click.prevent="goToProfile()" style="cursor: pointer">{{ completeName }}</span>
            </v-list-item-title>

            <v-list-item-subtitle>
               <span @click.prevent="goToProfile()" style="cursor: pointer">{{ listUser.username }}</span>
            </v-list-item-subtitle>

         </v-list-item-content>

         <v-list-item-action v-if="listUser.username != user.username">

            <v-btn small text width="100px" :dark="!listUser.following" :light="listUser.following" class="text-capitalize"
               v-ripple="false" :color="listUser.following ? 'gray lighten-4' : 'blue lighten-1'"
               @click.prevent="followUnfollow()">
               {{ listUser.following ? 'Siguiendo' : 'Seguir' }}
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
         listUser: {
            type: Object
         }
      },

      computed: {

         ...mapGetters({
            user: "auth/user",
            authenticated: "auth/authenticated"
         }),

         completeName(){
            return this.listUser.name + " " + this.listUser.lastname;
         },

         correctedImageUrl(){
            return this.listUser.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") +
                  this.listUser.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         }
      },

      methods: {

         goToProfile(){
            this.$router.push({name: "profile", params: {username: this.listUser.username}});
         },

         followUnfollow(){
            if(this.authenticated){

               if(this.listUser.following){
                  axios.delete("unfollow/" + this.listUser.username)
                     .catch((error) => {
                        console.log(error);
                     });
               }else{
                  axios.post("follow/" + this.listUser.username)
                     .catch((error) => {
                        console.log(error);
                     });
               }

               this.listUser.following = !this.listUser.following;
            }
         }
      }
   }

</script>
