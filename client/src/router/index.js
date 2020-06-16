
import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import Profile from "../views/profile/Profile";
import View404 from "../views/View404";

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
   },
   {
      path: "/:username",
      name: "profile",
      component: Profile,
      props: true
   },
   {
      path: '*',
      component: View404
   }
];

const router = new VueRouter({
   mode: 'history',
   base: process.env.BASE_URL,
   routes
})

export default router;
