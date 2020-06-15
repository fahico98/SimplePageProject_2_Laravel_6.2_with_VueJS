
<template>

   <div>

      <transition v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
         <img v-if="vuetify" src="../../assets/vuetify-logo.png" alt="Vuetify logo" :height="logosHeight">
      </transition>

      <transition v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
         <img v-if="vue" src="../../assets/vue-logo.png" alt="Vue logo" :height="logosHeight">
      </transition>

      <transition v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
         <img v-if="github" src="../../assets/github-logo.png" alt="Github logo" :height="logosHeight">
      </transition>

      <transition v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
         <img v-if="laravel" src="../../assets/laravel-logo.png" alt="Laravel logo" :height="logosHeight">
      </transition>

   </div>

</template>

<script>

   import Velocity from "velocity-animate";

   export default {

      data(){
         return {
            vuetify: false,
            vue: false,
            github: false,
            laravel: false,
            nextImage: "vue"
         }
      },

      props: [
         "logosHeight"
      ],

      mounted(){
         this.vuetify = true;
      },

      methods: {

         desactivateImages(){
            setTimeout(
               () => {
                  if(this.vuetify){
                     this.nextImage = "vue";
                     this.vuetify = false;
                  }else if(this.vue){
                     this.nextImage = "github";
                     this.vue = false;
                  }else if(this.github){
                     this.nextImage = "laravel";
                     this.github = false;
                  }else if(this.laravel){
                     this.nextImage = "vuetify";
                     this.laravel = false;
                  }
               },
               3000
            );
         },

         activateImages(){
            if(this.nextImage == "vuetify"){
               this.vuetify = true;
            }else if(this.nextImage == "vue"){
               this.vue = true;
            }else if(this.nextImage == "github"){
               this.github = true;
            }else if(this.nextImage == "laravel"){
               this.laravel = true;
            }
         },

         beforeEnter(el){
            el.style.opacity = 0;
         },

         // ********** Animation methods **********

         enter(el, done){
            var vm = this;
            Velocity(el, {opacity: 1}, {
                  duration: 500,
                  complete(){
                     done();
                     vm.desactivateImages();
                  }
               }
            );
         },

         leave(el, done){
            var vm = this;
            Velocity(el, {opacity: 0}, {
                  duration: 500,
                  complete(){
                     done();
                     vm.activateImages();
                  }
               }
            );
         }
      }
   }

</script>
