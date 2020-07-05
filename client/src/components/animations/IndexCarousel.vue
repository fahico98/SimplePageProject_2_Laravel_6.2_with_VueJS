
<template>

   <v-carousel cycle height="400" :show-arrows="false" hide-delimiter-background hide-delimiters>

      <v-carousel-item v-for="(slide, i) in slides" :key="i">

         <v-sheet color="grey lighten-4" height="100%">

            <v-row class="fill-height" align="center" justify="center">
               <div class="display-3 blue--text text--lighten-1">{{ slide }}</div>
            </v-row>

         </v-sheet>

      </v-carousel-item>

   </v-carousel>

</template>

<script>

   export default {

      data(){
         return {
            slides: [
               'active_options',
               'businessman_man',
               'freelancer',
               'google_analytics',
               'office'
            ],
         }
      }
   }

</script>
