
<template>

   <v-container class="my-0 py-0" fluid>
      <v-row>
         <v-col clos="12">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, facilis! Voluptate unde esse autem magnam dolores impedit, ab corporis quidem eligendi explicabo! In libero amet iste exercitationem iure delectus quibusdam.</p>
         </v-col>
      </v-row>
   </v-container>

</template>

<script>

   import { mapGetters } from "vuex";
   import axios from "axios";

   export default {

      props: [
         "username"
      ],

      components: {

      },

      computed: {
         ...mapGetters({
            user: "auth/user",
            authenticated: "auth/authenticated"
         })
      },

      mounted(){
         axios.post();
      }
   }

</script>
