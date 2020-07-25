
<template>

   <v-container class="mt-8 px-12">

      <div class="ma-0 pa-0" v-if="publicUserData.username == ''">
         <v-skeleton-loader class="mx-auto mb-5" type="avatar"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto mb-3" type="paragraph"></v-skeleton-loader>
         <v-skeleton-loader class="mx-auto" type="sentences"></v-skeleton-loader>
      </div>

      <div class="ma-0 pa-0" v-else>
         <v-row justify="center" align="center">
            <v-avatar size="250">
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

         <v-row class="mt-6">
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

         <v-row class="mt-6" v-if="profileOwner">
            <p v-if="isBio" class="subtitle-2 font-weight-regular my-0 py-0 black--text">{{ publicUserData.biography }}</p>
            <add-bio-modal-form @bioChangedSuccessfully="changeBio($event)" v-else justify="left" class="ma-0 pa-0"/>
         </v-row>

         <v-row class="mt-6" v-else>
            <p v-if="isBio" class="subtitle-2 font-weight-regular my-0 py-0 black--text">{{ publicUserData.biography }}</p>
         </v-row>
      </div>

   </v-container>

</template>

<script>

   import AddBioModalForm from "./modals/AddBioModalForm";
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
         AddBioModalForm
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
               axios.defaults.baseURL.replace("/api", "") + this.publicUserData.profile_picture : "";
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
         }
      }
   }
</script>
