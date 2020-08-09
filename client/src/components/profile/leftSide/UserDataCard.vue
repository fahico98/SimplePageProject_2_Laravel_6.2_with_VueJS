
<template>

   <v-container class="my-5 px-12">

      <div class="ma-0 pa-0" v-if="cardUserData.username == ''">
         <v-skeleton-loader class="mx-auto mb-5" type="avatar"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto mb-3" type="paragraph"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto" type="sentences"></v-skeleton-loader>
      </div>

      <div class="ma-0 pa-0" v-else>

         <v-row justify="center" align="center">
            <profile-picture-modal-form v-if="profileOwner && authenticated" :imageUrl="correctedImageUrl"
               :completeName="completeName" @imageChangedSuccessfully="changeProfilePicture($event)"/>
            <v-avatar size="250" v-else>
               <img :src="correctedImageUrl" :alt="completeName">
            </v-avatar>
         </v-row>

         <v-row class="mt-6">
            <p class="my-0 py-0">
               <span class="text-h5 font-weight-bold black--text">{{ completeName }}</span>
            </p>
         </v-row>

         <v-row class="mt-0">
            <p class="my-0 py-0">
               <span class="text-h6 font-weight-light grey--text">{{ cardUserData.username }}</span>
            </p>
         </v-row>

         <v-row class="mt-5" v-if="!profileOwner">
            <follow-user-form :username="cardUserData.username" :following="cardUserData.following"
               @changeFollowingState="changeFollowing()"/>
         </v-row>

         <v-row class="mt-5">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-email-outline</v-icon>&nbsp;{{ cardUserData.email }}
            </p>
         </v-row>

         <v-row class="mt-2">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-crosshairs-gps</v-icon>&nbsp;{{ location }}
            </p>
         </v-row>

         <v-row class="mt-2">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-cellphone-android</v-icon>&nbsp;{{ cardUserData.phone_number }}
            </p>
         </v-row>

         <div v-if="profileOwner" class="ma-0 pa-0">

            <v-row v-if="isBio" class="mt-5">
               <v-col cols="11" class="ma-0 pa-0">
                  <p class="subtitle-2 font-weight-regular my-0 py-0 black--text">
                     {{ cardUserData.biography }}
                  </p>
               </v-col>
               <v-col cols="1" class="ma-0 pa-0">
                  <add-edit-bio-modal-form @bioChangedSuccessfully="changeBio($event)" justify="left" class="ma-0 pa-0"
                     :action="'edit'" :bioProp="cardUserData.biography"/>
               </v-col>
            </v-row>

            <v-row v-else class="mt-5">
               <add-edit-bio-modal-form @bioChangedSuccessfully="changeBio($event)" :action="'store'" justify="left"
                  class="ma-0 pa-0"/>
            </v-row>
         </div>

         <div v-else>
            <v-row class="mt-5">
               <p v-if="isBio" class="subtitle-2 font-weight-regular my-0 py-0 black--text">
                  {{ cardUserData.biography }}
               </p>
            </v-row>
         </div>

      </div>

   </v-container>

</template>

<script>

   import AddEditBioModalForm from "../modals/AddEditBioModalForm";
   import ProfilePictureModalForm from "../modals/ProfilePictureModalForm";
   import FollowUserForm from "../leftSide/FollowUserForm";
   import { mapActions, mapGetters } from "vuex";
   import axios from "axios";

   export default {

      components: {
         AddEditBioModalForm,
         ProfilePictureModalForm,
         FollowUserForm
      },

      props: {
         cardUserData: {
            type: Object
         }
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         correctedImageUrl(){
            return this.cardUserData.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") +
                  this.cardUserData.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         },

         profileOwner(){
            return this.authenticated ? this.user.username === this.cardUserData.username : false;
         },

         completeName(){
            return this.cardUserData.name + ' ' + this.cardUserData.lastname;
         },

         location(){
            return this.cardUserData.city + " - " + this.cardUserData.country;
         },

         isBio(){
            return !!this.cardUserData.biography;
         }
      },

      methods: {

         ...mapActions({
            setProfilePicture: "auth/setProfilePicture",
            setBio: "auth/setBio"
         }),

         changeBio(bio){
            this.cardUserData.biography = bio;
            this.setBio(bio);
         },

         changeProfilePicture(profilePicture){
            this.cardUserData.profile_picture = profilePicture;
            this.correctImageUrl();
            this.setProfilePicture(this.cardUserData.profile_picture);
         },

         changeFollowing(){
            this.cardUserData.following = !this.cardUserData.following;
         }
      }
   }
</script>

<style scoped>

   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

   .montserrat{
      font-family: 'Montserrat', sans-serif !important;
   }

</style>
