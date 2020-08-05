
<template>

   <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">

         <template v-slot:activator="{ on, attrs }">
            <v-btn small dark depressed v-ripple="false" color="blue lighten-1" width="100%" class="text-capitalize"
               v-bind="attrs" v-on="on">Publicar</v-btn>
         </template>


         <v-card :loading="loading">

            <v-card-title class="headline">Nueva publicación</v-card-title>

            <v-form class="mt-5 pa-0" @submit.prevent="">

               <v-text-field dense outlined counter="120" color="blue lighten-1" label="Título" class="px-5" v-model="title"
                  @input="$v.title.$touch()" :error-messages="titleErrors"/>

               <v-textarea no-resize outlined v-model="content" counter="250" color="blue lighten-1" rows="4" class="px-5"
                  label="Contenido" @input="$v.content.$touch()" :error-messages="contentErrors"/>

               <v-file-input small-chips multiple outlined dense color="blue lighten-1" prepend-icon="mdi-image-multiple"
                  class="px-5" label="Fotos de la publicación" ref="imagesInput" @change="$v.images.$touch()"
                  :error-messages="imagesErrors" v-model="images"></v-file-input>

               <v-select outlined dense :items="items" v-model="privacy" color="blue lighten-1" class="px-5"
                  label="Quien puede ver este post ?" prepend-icon="mdi-lock"></v-select>

               <v-card-actions>

                  <v-btn depressed dark @click="submit()" type="submit" class="mb-2 ml-3 text-capitalize" color="blue lighten-1">
                     <span class="px-2">Publicar</span>
                  </v-btn>

                  <v-btn depressed light @click="limpiarCampos()" class="mb-2 ml-3 text-capitalize" color="grey lighten-1">
                     <span class="px-2">Limpiar campos</span>
                  </v-btn>

               </v-card-actions>

            </v-form>
         </v-card>

      </v-dialog>
   </v-row>

</template>

<script>

   import axios from "axios";
   import { mapGetters } from "vuex";
   import { validationMixin } from "vuelidate";
   import { helpers, maxLength, minLength, required } from "vuelidate/lib/validators";

   const alphaNum = helpers.regex("alphaNum", /^[ _\-\nñÑ.,;:()áéíóúa-zA-Z0-9]*$/);
   const imagesLen = (images) => images ? images.length <= 5 : false;
   const size = (images) => images ? images.every(image => image.size <= 2e6) : false;

   export default {

      mixins: [validationMixin],

      data(){
         return {
            loading: false,
            dialog: false,
            title: "",
            content: "",
            images: [],
            privacy: 1,
            items: [
               { value: 1, text: "Público" },
               { value: 2, text: "Seguidores" },
               { value: 3, text: "Solo yo" }
            ]
         }
      },

      validations: {
         title: { required, alphaNum, maxLength: maxLength(120) },
         content: { required, alphaNum, maxLength: maxLength(250), minLength: minLength(10) },
         images: { size, imagesLen }
      },

      watch: {
         dialog(dialog){
            if(!dialog){
               this.images = [];
               this.title = "";
               this.content = "";
               this.privacy = { value: 1, text: "Público" };
               this.$v.$reset();
            }
         }
      },

      computed: {

         titleErrors(){
            const errors = [];
            if(!this.$v.title.$dirty){ return errors; }
            !this.$v.title.maxLength && errors.push('Máximo 120 caracteres.');
            !this.$v.title.alphaNum && errors.push('No se admite caracteres especiales.');
            !this.$v.title.required && errors.push('El titulo de la publicación no puede estar vacío.');
            return errors;
         },

         contentErrors(){
            const errors = [];
            if(!this.$v.content.$dirty){ return errors; }
            !this.$v.content.maxLength && errors.push('Máximo 250 caracteres.');
            !this.$v.content.minLength && errors.push('Mínimo 10 caracteres.');
            !this.$v.content.alphaNum && errors.push('No se admite caracteres especiales.');
            !this.$v.content.required && errors.push('El contenido de la publicación es obligatorio.');
            return errors;
         },

         imagesErrors(){
            const errors = [];
            if(!this.$v.images.$dirty){ return errors; }
            !this.$v.images.size && errors.push("Ninguna de las imagenes cargadas debe tener un tamaño superior a 2MB.");
            !this.$v.images.imagesLen && errors.push("Las publicaciones no pueden tener mas de 5 fotos.");
            return errors;
         },

         ...mapGetters({
            user: "auth/user"
         })
      },

      methods: {

         submit(){
            this.$v.$touch();
            if(!this.$v.$invalid){
               this.loading = "blue lighten-1";
               var formData = new FormData();
               formData.append("title", this.title);
               formData.append("content", this.content);
               formData.append("privacy", this.privacy);
               for(var i = 0; i < this.images.length; i++){
                  let image = this.images[i];
                  formData.append('images[' + i + ']', image);
               }
               axios.post("posts/store", formData, {headers: {'Content-Type': 'multipart/form-data'}})
                  .then((response) => {
                     if(response.data){
                        this.loading = false;
                        this.dialog = false;
                        this.title = "";
                        this.content = "";
                        this.images = [];
                        this.privacy = 1;
                        if(this.$route.name == "profile" && this.$route.params.username == this.user.username){
                           /* Investigar si se puede hacer de forma mas elegante la redirección. */
                           this.$router.go(this.$router.currentRoute);
                        }
                     }
                  })
                  .catch((error) => {
                     console.log(error);
                  });
            }
         },

         limpiarCampos(){

         }
      }
   }

</script>
