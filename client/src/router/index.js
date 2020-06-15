
import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";

Vue.use(VueRouter);

const routes = [
   {
      path: '/',
      name: 'home',
      component: Home
   },
   {
      path: '/iniciar_sesion',
      name: 'login',
      component: Login
   },
   {
      path: "/registro",
      name: "register",
      component: Register
   }
];

const router = new VueRouter({
   mode: 'history',
   base: process.env.BASE_URL,
   routes
})

export default router;
