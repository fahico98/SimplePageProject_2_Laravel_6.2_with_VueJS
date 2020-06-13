
<template>

   <div>

      <v-form class="ma-0 pa-0">
         <v-text-field outlined color="blue lighten-1" v-model="username" label="Nombre de usuario" class="ma-0 pa-0"
            dense required></v-text-field>
         <v-text-field outlined color="blue lighten-1" v-model="password" label="Contraseña" type="password" class="ma-0 pa-0"
            dense required></v-text-field>
         <v-checkbox dense class="ma-0 pa-0" color="blue lighten-1" v-model="rememberMe" label="Recuerdame"></v-checkbox>
         <v-btn type="submit" color="blue lighten-1 text-capitalize" dark depressed>Enviar</v-btn>
      </v-form>

   </div>

</template>

<script>

   export default {

      data(){
         return {
            username: "",
            password: "",
            rememberMe: false
         }
      }

   }

</script>
