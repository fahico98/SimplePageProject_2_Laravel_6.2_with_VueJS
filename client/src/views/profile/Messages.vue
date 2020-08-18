
<template>

   <v-container class="ma-0 pa-0">

         <left-bar class="grey lighten-4"/>
         <right-bar class="grey lighten-4"/>

         <div class="mx-2">

            <v-container class="ma-0 pa-0 grey lighten-4" style="margin-top: 160px;">
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eaque quia aperiam blanditiis
               explicabo voluptate quam, magnam perspiciatis sint ab nemo exercitationem accusamus! Incidunt
               laudantium at, deserunt adipisci delectus quo!
            </v-container>

         </div>

   </v-container>

</template>

<script>

   import LeftBar from "../../components/profile/leftSide/LeftBar";
   import RightBar from "../../components/profile/rightSide/RightBar";
   import { mapGetters } from "vuex";

   export default {

      data(){
         return {

         }
      },

      components: {
         RightBar,
         LeftBar
      },

      computed: {
         ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
         })
      },

      methods: {

      }
   }

</script>
