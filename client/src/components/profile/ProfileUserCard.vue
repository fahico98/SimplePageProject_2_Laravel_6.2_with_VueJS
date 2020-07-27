
<template>

   <v-container class="my-8 px-12">

      <div class="ma-0 pa-0" v-if="publicUserData.username == ''">
         <v-skeleton-loader class="mx-auto mb-5" type="avatar"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto mb-3" type="paragraph"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto" type="sentences"></v-skeleton-loader>
      </div>

      <div class="ma-0 pa-0" v-else>

         <v-row justify="center" align="center">
            <profile-picture-modal-form v-if="profileOwner && authenticated" :imageUrl="imageUrl" :completeName="completeName"
               @imageChangedSuccessfully="changeProfilePicture($event)"/>
            <v-avatar size="250" v-else>
               <img :src="imageUrl" :alt="completeName">
            </v-avatar>
         </v-row>

         <v-row class="mt-6">
            <p class="my-0 py-0">
               <span class="text-h5 font-weight-bold black--text">{{ completeName }}</span>
            </p>
         </v-row>

         <v-row class="mt-0">
            <p class="my-0 py-0">
               <span class="text-h6 font-weight-light grey--text">{{ publicUserData.username }}</span>
            </p>
         </v-row>

         <v-row class="mt-5">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-email-outline</v-icon>&nbsp;{{ publicUserData.email }}
            </p>
         </v-row>

         <v-row class="mt-2">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-crosshairs-gps</v-icon>&nbsp;{{ location }}
            </p>
         </v-row>

         <v-row class="mt-2">
            <p class="my-0 py-0 subtitle-2 font-weight-regular blue--text text--lighten-1">
               <v-icon medium dense color="blue linghten-1">mdi-cellphone-android</v-icon>&nbsp;{{ publicUserData.phone_number }}
            </p>
         </v-row>

         <div v-if="profileOwner" class="ma-0 pa-0">

            <v-row v-if="isBio" class="mt-5">
               <v-col cols="11" class="ma-0 pa-0">
                  <p class="subtitle-2 font-weight-regular my-0 py-0 black--text montserrat">
                     {{ publicUserData.biography }}
                  </p>
               </v-col>
               <v-col cols="1" class="ma-0 pa-0">
                  <add-bio-modal-form @bioChangedSuccessfully="changeBio($event)" justify="left" class="ma-0 pa-0"
                     :action="'edit'" :bioProp="publicUserData.biography"/>
               </v-col>
            </v-row>

            <v-row v-else class="mt-5">
               <add-bio-modal-form @bioChangedSuccessfully="changeBio($event)" :action="'store'" justify="left" class="ma-0 pa-0"/>
            </v-row>
         </div>

         <div v-else>
            <v-row class="mt-5">
               <p v-if="isBio" class="subtitle-2 font-weight-regular my-0 py-0 black--text montserrat">
                  {{ publicUserData.biography }}
               </p>
            </v-row>
         </div>

      </div>

   </v-container>

</template>

<script>

   import AddBioModalForm from "./modals/AddBioModalForm";
   import ProfilePictureModalForm from "./modals/ProfilePictureModalForm";
   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){

         return {
            username: "",
            publicUserData: {
               username: "",
               name: "",
               lastname: "",
               country: "",
               city: "",
               phone_number: "",
               email: "",
               password: "",
               role_id: "",
               profile_picture: "",
               biography: ""
            }
         }
      },

      components: {
         AddBioModalForm,
         ProfilePictureModalForm
      },

      computed: {

         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         profileOwner(){
            return this.authenticated ? this.user.username === this.publicUserData.username : false;
         },

         imageUrl(){
            return this.publicUserData.profile_picture ?
               axios.defaults.baseURL.replace("/api", "") +
               this.publicUserData.profile_picture.replace("public/", "storage/") : "";
         },

         completeName(){
            return this.publicUserData.name + ' ' + this.publicUserData.lastname;
         },

         location(){
            return this.publicUserData.city + " - " + this.publicUserData.country;
         },

         isBio(){
            return !!this.publicUserData.biography;
         }
      },

      async beforeCreate(){

         this.username = this.$route.name == "profile" ? this.$route.params.username : "";
         let response;

         try{
            if(this.authenticated){
               if(this.username === this.user.username){
                  this.publicUserData = this.user;
               }else{
                  response = await axios.get("public_user_data/" + this.username);
                  this.publicUserData = response.data;
               }
            }else{
               response = await axios.get("public_user_data/" + this.username);
               this.publicUserData = response.data;
            }
         }catch(error){
            console.log(error);
         }
      },

      methods: {
         changeBio(bio){
            this.publicUserData.biography = bio;
         },

         changeProfilePicture(profilePicture){
            this.publicUserData.profile_picture = profilePicture;
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
