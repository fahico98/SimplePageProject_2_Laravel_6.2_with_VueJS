
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import axios from "axios";
import vuelidate from "vuelidate";

require("@/store/subscriber");

axios.defaults.baseURL = "http://homestead.test/api/";
Vue.config.productionTip = false;

Vue.use(vuelidate);

store.dispatch("auth/meAction", localStorage.getItem("token"))
   .then(() => {
      new Vue({
        router,
        store,
        vuetify,
        render: h => h(App)
      }).$mount('#app')
   });

