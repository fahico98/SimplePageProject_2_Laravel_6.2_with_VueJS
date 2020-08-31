
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <!-- <v-text-field color="blue lighten-1" v-model.trim="form.name" label="Nombre" class="ma-0 pa-0 mt-1"
               @input="$v.form.name.$touch()" @blur="$v.form.name.$touch()" :error-messages="nameErrors" outlined dense
               required></v-text-field> -->

            <v-text-field color="blue lighten-1" v-model.trim="form.name" label="Nombre" class="ma-0 pa-0"
               @input="$v.form.name.$touch()" @blur="$v.form.name.$touch()" :error-messages="nameErrors" outlined dense
               required></v-text-field>

            <v-text-field color="blue lighten-1" v-model.trim="form.lastname" label="Apellido" class="ma-0 pa-0 mt-1"
               @input="$v.form.lastname.$touch()" @blur="$v.form.lastname.$touch()" :error-messages="lastnameErrors" outlined
               dense required></v-text-field>

            <v-text-field color="blue lighten-1" v-model.trim="form.username" label="Nombre de usuario" class="ma-0 pa-0 mt-1"
               outlined dense required disabled></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">
            <v-textarea cols="20" rows="5" counter="120" label="Biografía" outlined no-resize dense></v-textarea>
         </v-col>

      </v-row>

   </v-container>

</template>

<script>



   export default {

      data(){
         return {
            form: {
               name: "",
               lastname: "",
               username: "",
               bio: ""
            }
         }
      }
   }

</script>
