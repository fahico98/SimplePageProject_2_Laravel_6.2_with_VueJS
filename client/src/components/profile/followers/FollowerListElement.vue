
<template>

   <v-list-item>
      <v-list-item-content>

         <v-list-item-title>{{ completeName }}</v-list-item-title>
         <v-list-item-subtitle>{{ follower.username }}</v-list-item-subtitle>

      </v-list-item-content>
   </v-list-item>

</template>

<script>

   export default {

      data(){
         return {
            followingSatate: true
         }
      },

      props: {
         follower: {
            type: Object
         }
      },

      computed: {
         completeName(){
            return this.follower.name + " " + this.follower.lastname;
         }
      }
   }

</script>
