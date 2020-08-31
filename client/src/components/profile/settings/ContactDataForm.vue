
<template>

   <v-container class="ma-0 pa-0">

      <v-row class="ma-0 pa-0">

         <v-col cols="6" class="ma-0 pa-0 pr-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.email" class="ma-0 pa-0 mt-1" label="Correo electrónico"
               @input="$v.form.email.$reset()" @blur="$v.form.email.$touch()" :error-messages="emailErrors"
               :loading="emailFieldLoading" outlined dense required></v-text-field>

         </v-col>

         <v-col cols="6" class="ma-0 pa-0 pl-3">

            <v-text-field color="blue lighten-1" v-model.trim="form.phone_number" class="ma-0 pa-0 mt-1" label="Número telefónico"
               @input="$v.form.phone_number.$touch()" @blur="$v.form.phone_number.$touch()" :error-messages="phoneNumberErrors"
               type="number" outlined dense></v-text-field>

         </v-col>

      </v-row>

   </v-container>

</template>

<script>



   export default {

      data(){
         return {
            form: {
               email: "",
               phoneNumber: ""
            }
         }
      }
   }

</script>
