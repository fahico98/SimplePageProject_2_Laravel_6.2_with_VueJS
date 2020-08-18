
<template>

   <div>

      <v-btn large depressed rounded text color="white" class="mr-2 pr-2" :ripple="false" @click.prevent="goToProfile()">
         <span class="text-lowercase mr-2">{{ user.username }}</span>
         <v-avatar size="40">
            <img :src="correctedImageUrl" :alt="user.username">
         </v-avatar>
      </v-btn>

      <!-- <v-menu :close-on-click="true" :close-on-content-click="true" :offset-y="true">

         <template v-slot:activator="{ on, attrs }">
            <v-btn color="white" class="mr-5" v-bind="attrs" v-on="on" :ripple="false" icon x-small>
               <v-avatar size="40">
                  <img :src="correctedImageUrl" :alt="user.username">
               </v-avatar>
            </v-btn>
         </template>

         <v-list dense width="150px">

            <v-list-item justify="center" :ripple="false" v-on:click="goToProfile()">
               <v-list-item-title class="body-2 font-weight-bold">{{ user.username }}</v-list-item-title>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-item :ripple="false" v-on:click="goTo('auth_home')">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">inicio</v-list-item-title>
            </v-list-item>

            <v-list-item :ripple="false" v-on:click="console.log('...')">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">mensajes</v-list-item-title>
            </v-list-item>

            <v-list-item :ripple="false" v-on:click="console.log('...')">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">configuración</v-list-item-title>
            </v-list-item>

            <v-list-item :ripple="false" v-on:click="logout()">
               <v-list-item-title class="text-capitalize body-2 font-weight-light">cerrar sesión</v-list-item-title>
            </v-list-item>

         </v-list>

      </v-menu> -->
   </div>

</template>

<script>

   import { mapActions, mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            //
         }
      },

      computed: {

         ...mapGetters({
            user: "auth/user"
         }),

         correctedImageUrl(){
            return this.user.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") +
                  this.user.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         },
      },

      methods: {

         ...mapActions({
            logoutAction: "auth/logoutAction"
         }),

         logout(){
            this.logoutAction()
               .then(() => {
                  this.$router.push({name: "login"});
               })
               .catch((error) => {
                  console.log(error);
               });
         },

         goToProfile(){
            if(this.$route.params.username != this.user.username){
               this.$router.push(
                  {
                     name: "posts",
                     params: {username: this.user.username}
                  }
               );
            }
         },

         goTo(routeName){
            this.$router.push({name: routeName});
         }
      }
   }

</script>
