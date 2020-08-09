
<template>

   <div>
      <v-dialog v-model="dialog" width="450px">

         <template v-slot:activator="{ on, attrs }">
            <v-avatar size="250" v-bind="attrs" v-on="on"><img :src="imageUrl" :alt="completeName"></v-avatar>
         </template>

         <v-card :loading="loading">
            <v-card-title class="headline">Cargar foto de perfil</v-card-title>
            <v-form class="ma-0 pa-0" @submit.prevent="">

               <v-file-input outlined dense prepend-icon="mdi-camera" color="blue lighten-1" class="mx-6 mt-5" v-model="image"
                  label="Foto de perfil" accept="image/*" @input="$v.image.$touch()" :error-messages="imageErrors"/>

               <v-card-actions>
                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1"
                     v-ripple="false">
                     <span class="px-2">Cargar</span>
                  </v-btn>
               </v-card-actions>

            </v-form>
         </v-card>

      </v-dialog>
   </div>

</template>

<script>

   import axios from "axios";
   import { validationMixin } from "vuelidate";
   import { required } from "vuelidate/lib/validators";

   const size = (image) => image ? image.size <= 2000000 : false;

   export default {

      mixins: [validationMixin],

      data(){
         return {
            dialog: false,
            loading: false,
            image: null
         }
      },

      validations: {
         image: {size, required}
      },

      computed: {
         imageErrors(){
            const errors = [];
            if(!this.$v.image.$dirty){ return errors; }
            !this.$v.image.required && errors.push('Aún no ha cargado ningúna imagen.');
            !this.$v.image.size && errors.push('La imagen no debe tener un tamaño superior a 2MB.');
            return errors;
         },
      },

      props: {
         imageUrl: {
            required: true,
            type: String
         },
         completeName: {
            required: true,
            type: String
         }
      },

      watch: {
         dialog(dialog){
            if(!dialog){
               this.image = null;
               this.$v.$reset();
            }
         }
      },

      methods: {
         submit(){
            this.$v.$touch();
            if(!this.$v.$invalid){
               this.loading = "blue lighten-1";
               var formData = new FormData();
               formData.append("image", this.image);
               axios.post("store_profile_picture", formData, {headers: {'Content-Type': 'multipart/form-data'}})
                  .then((response) => {
                     if(response.data){
                        this.$emit("imageChangedSuccessfully", response.data);
                        this.image = null;
                        this.loading = false;
                        this.dialog = false;
                     }
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         }
      }
   }

</script>
