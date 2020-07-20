
<template>

   <v-row class="fill-height mx-16 py-10">
      <v-col class="col-1 offset-1" justify="center" align="center">
         <v-icon x-large color="blue lighten-1">mdi-format-quote-open</v-icon>
      </v-col>
      <v-col class="col-8" justify="center" align="center">

         <v-carousel cycle interval="8000" height="350px" :show-arrows="false" hide-delimiter-background hide-delimiters>
            <v-carousel-item v-for="testimonial in testimonials" :key="testimonial.id" class="mx-16">

               <v-avatar size="60">
                  <img :src="userImageUrl(testimonial.user.profile_picture)"
                     :alt="testimonial.user.name + ' ' + testimonial.user.lastname">
               </v-avatar>

               <p class="text-h5 blue--text text--lighten-1 pacifico text-center mt-5">
                  {{ testimonial.user.name + ' ' + testimonial.user.lastname }}
               </p>

               <p class="text-h6 mt-10 black--text text-center font-weight-regular">{{ testimonial.content }}</p>

            </v-carousel-item>
         </v-carousel>

      </v-col>
      <v-col class="col-1" justify="center" align="center">
         <v-icon x-large color="blue lighten-1">mdi-format-quote-close</v-icon>
      </v-col>
   </v-row>

</template>

<script>

   import axios from "axios";

   export default {

      data(){
         return {
            testimonials: []
         }
      },

      mounted(){
         axios.get("testimonials")
            .then((response) => {
               this.testimonials = response.data;
            })
            .catch((error) => {
               console.log("Error: " + error);
            });
      },

      methods: {
         userImageUrl(profile_picture){
            return axios.defaults.baseURL.replace("/api", "") + profile_picture;
         },
      }
   }

</script>

<style scoped>

   @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

   .pacifico{
      font-family: 'Pacifico', cursive !important;
   }

</style>
