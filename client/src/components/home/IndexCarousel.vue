
<template>

   <v-carousel cycle interval="8000" height="450px" :show-arrows="false" hide-delimiter-background hide-delimiters>

      <v-carousel-item>
         <v-sheet color="grey lighten-4" height="100%">
            <v-row class="fill-height" align="center" justify="center">
               <v-col class="col-4">
                  <img src="../../assets/unDraw/active_options.png" alt="Active options" height="450px">
               </v-col>
               <v-col class="col-7">
                  <p class="text-h5 blue--text text--lighten-1 pacifico" align="left">
                     Active options.
                  </p>
                  <p class="black--text" align="left">
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae consectetur incidunt itaque
                     repellat iure consequatur, magnam laborum at quibusdam cumque illo! Modi, sapiente.
                  </p>
               </v-col>
            </v-row>
         </v-sheet>
      </v-carousel-item>

      <v-carousel-item>
         <v-sheet color="grey lighten-4" height="100%">
            <v-row class="fill-height" align="center" justify="center">

               <v-col class="col-5">
                  <img src="../../assets/unDraw/businessman_man.png" alt="Business man" height="450px">
               </v-col>
               <v-col class="col-6">
                  <p class="text-h5 blue--text text--lighten-1 pacifico" align="left">
                     Businessman man.
                  </p>
                  <p align="left" class="black--text">
                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis nam earum recusandae non
                     alias repudiandae necessitatibus eaque, minus repellendus non sit aperiam corrupti?
                  </p>
               </v-col>

            </v-row>
         </v-sheet>
      </v-carousel-item>

      <v-carousel-item>
         <v-sheet color="grey lighten-4" height="100%">
            <v-row class="fill-height" align="center" justify="center">
               <v-col class="col-6">
                  <img src="../../assets/unDraw/freelancer.png" alt="Freelancer" height="380px">
               </v-col>
               <v-col class="col-6">
                  <p class="text-h5 blue--text text--lighten-1 pacifico" align="left">
                     Freelancer.
                  </p>
                  <p class="black--text" align="left">
                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis nam earum recusandae non
                     alias repudiandae necessitatibus eaque, vero dicta minus repellendus non sit aperiam corrupti?
                  </p>
               </v-col>
            </v-row>
         </v-sheet>
      </v-carousel-item>

      <v-carousel-item>
         <v-sheet color="grey lighten-4" height="100%">
            <v-row class="fill-height" align="center" justify="center">
               <v-col class="col-6">
                  <img src="../../assets/unDraw/google_analytics.png" alt="Google analitics" height="400px">
               </v-col>
               <v-col class="col-6">
                  <p class="text-h5 blue--text text--lighten-1 pacifico" align="left">
                     Google analitics.
                  </p>
                  <p class="black--text" align="left">
                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis nam earum recusandae non
                     alias repudiandae necessitatibus eaque, vero dicta minus repellendus non sit aperiam corrupti?
                  </p>
               </v-col>
            </v-row>
         </v-sheet>
      </v-carousel-item>

      <v-carousel-item>
         <v-sheet color="grey lighten-4" height="100%">
            <v-row class="fill-height" align="center" justify="center">
               <v-col class="col-4">
                  <img src="../../assets/unDraw/office.png" alt="Office" height="400px">
               </v-col>
               <v-col class="col-6 offset-2">
                  <p class="text-h5 blue--text text--lighten-1 pacifico" align="left">
                     Office.
                  </p>
                  <p class="black--text" align="left">
                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis nam earum recusandae non
                     alias repudiandae necessitatibus eaque, vero dicta minus repellendus non sit aperiam corrupti?
                  </p>
               </v-col>
            </v-row>
         </v-sheet>
      </v-carousel-item>

   </v-carousel>

</template>

<script>

   export default {

      data(){
         return {
            imageNames: {

            }
         }
      }
   }

</script>

<style scoped>

   @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

   .pacifico{
      font-family: 'Pacifico', cursive !important;
   }

</style>
