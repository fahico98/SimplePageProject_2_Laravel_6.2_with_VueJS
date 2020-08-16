
<template>

   <div style="display: inline">
      <v-dialog scrollable v-model="dialog" max-width="400px" max-height="500px">

         <template v-slot:activator="{ on, attrs }">
            <div class="pa-5 d-flex">
               <v-btn dark depressed v-ripple="false" color="blue lighten-1" width="100%" class="text-capitalize mb-5"
                  v-bind="attrs" v-on="on">Nueva conversación</v-btn>
            </div>
         </template>

         <v-card>

            <v-card-title class="headline pt-5">Buscar usuario</v-card-title>

            <v-card-text class="pt-0">
               Puedes enviar mensajes instantaneos a cualquiera de los usuarios que estas siguiendo.
            </v-card-text>

               <v-text-field dense outlined color="blue lighten-1" label="Nombre de usuario" class="px-5"
                  append-icon="mdi-magnify" v-model="browsedUsername"/>

               <v-divider></v-divider>

               <v-card-text style="height: 300px;" class="px-2">

                  <div class="ma-0 pa-0" v-if="skeleton">
                     <v-skeleton-loader class="ma-0 pa-0" type="list-item-avatar-two-line" v-for="i in new Array(10)" :key="i"/>
                  </div>

                  <v-list flat v-else>

                     <v-list-item class="px-2" style="cursor: pointer" v-for="listUser in filteredFollowed" :key="listUser.id"
                        @click.prevent="newTalk(listUser)">

                        <v-list-item-avatar>
                           <v-img :src="correctedImageUrl(listUser)"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>

                           <v-list-item-title>
                              <span class="blue--text text--lighten-1">{{ completeName(listUser) }}</span>
                           </v-list-item-title>

                           <v-list-item-subtitle>
                              <span>{{ listUser.username }}</span>
                           </v-list-item-subtitle>

                        </v-list-item-content>

                     </v-list-item>
                  </v-list>
               </v-card-text>

               <v-divider></v-divider>

               <v-card-actions class="ma-2">
                  <v-btn depressed dark v-ripple="false" class="text-capitalize" color="blue lighten-1" @click="dialog = false">
                     <span class="px-2">Cancelar</span>
                  </v-btn>
               </v-card-actions>

         </v-card>

      </v-dialog>
   </div>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      data(){
         return {
            browsedUsername: "",
            dialog: false,
            skeleton: true,
            followed: []
         }
      },

      watch: {
         dialog(dialog){
            if(!dialog){
               this.browsedUsername = "";
               this.item = null;
            }
         }
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         }),

         filteredFollowed(){
            return this.followed.filter((user) => {
               return user.username.toLowerCase().indexOf(this.browsedUsername.toLowerCase()) !== -1;
            })
         }
      },

      mounted(){
         axios.get("all_followers_followed/followed")
            .then((response) => {
               if(response.data){
                  this.followed = response.data;
                  this.skeleton = false;
               }
            })
            .catch((error) => {
               console.log(error)
            });
      },

      methods: {

         completeName(user){
            return `${user.name} ${user.lastname}`;
         },

         correctedImageUrl(user){
            return user.profile_picture
               ? axios.defaults.baseURL.replace("/api", "") + user.profile_picture.url.replace("public/", "storage/")
               : axios.defaults.baseURL.replace("/api", "") + "storage/avatars/defaultUserPhoto.jpg";
         },

         async newTalk(user){
            this.dialog = false;
            this.$emit("skeleton");
            await axios.post("messages/new_talk", {recipient_id: user.id})
               .then((response) => {
                  if(response.data){
                     this.$emit("newTalk", {
                        messages_number: 0,
                        recipient: user,
                        sender: this.user
                     });
                  }
               })
               .catch((error) => {
                  console.log(error);
               });
         }
      }
   }

</script>
