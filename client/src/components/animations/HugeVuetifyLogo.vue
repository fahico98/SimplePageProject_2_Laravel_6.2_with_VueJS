
<template>

   <transition v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
      <img v-if="show" src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png" alt="Vue logo" width="360px">
   </transition>

</template>

<script>

   import Velocity from "velocity-animate";

   export default {

      data(){
         return {
            show: true
         }
      },

      mounted(){
         this.show = false;
      },

      methods: {

         beforeEnter(el){
            el.style.opacity = 0;
         },

         enter(el, done){
            var vm = this;
            Velocity(el,
               {
                  opacity: 1
               },
               {
                  duration: 500,
                  complete(){
                     done();
                     setTimeout(() => {vm.show = false}, 2000);
                  }
               }
            );
         },

         leave(el, done){
            var vm = this;
            Velocity(el,
               {
                  opacity: 0
               },
               {
                  duration: 500,
                  complete(){
                     done();
                     vm.show = true;
                  }
               }
            );
         }
      }
   }

</script>
