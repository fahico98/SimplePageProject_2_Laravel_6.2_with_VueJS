
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model="form.password" label="Contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.password.$touch()" @blur="$v.form.password.$touch()" :error-messages="passwordErrors"
               type="password" outlined dense required></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model="form.new_password" label="Nueva contraseña" class="ma-0 pa-0 mt-1"
               @input="$v.form.new_password.$touch()" @blur="$v.form.new_password.$touch()" :error-messages="passwordErrors"
               type="password" outlined dense required></v-text-field>

            <v-text-field color="blue lighten-1" v-model="form.password_confirmation" label="Confirmación de nueva contraseña"
               class="ma-0 pa-0 mt-1" @input="$v.form.password_confirmation.$touch()" @blur="$v.form.password_confirmation.$touch()"
               :error-messages="confPasswordErrors" type="password" outlined dense required></v-text-field>

         </v-col>

      </v-row>

   </v-container>

</template>

<script>



   export default {

      data(){
         return {
            form: {
               password: "",
               password_confirmation: ""
            }
         }
      }
   }

</script>
