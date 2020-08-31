
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.country" label="País" class="ma-0 pa-0 mt-1"
               @input="$v.form.country.$touch()" @blur="$v.form.country.$touch()" :error-messages="countryErrors" outlined
               dense></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.city" label="Ciudad" class="ma-0 pa-0 mt-1"
               @input="$v.form.city.$touch()" @blur="$v.form.city.$touch()" :error-messages="cityErrors" outlined dense>
               </v-text-field>

         </v-col>

      </v-row>

   </v-container>

</template>

<script>



   export default {

      data(){
         return {
            form: {
               country: "",
               city: ""
            }
         }
      }
   }

</script>
