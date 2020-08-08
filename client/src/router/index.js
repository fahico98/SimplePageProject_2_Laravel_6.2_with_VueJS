
import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../views/Home";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import Profile from "../views/profile/Profile";
import View404 from "../views/View404";

import Posts from "../components/profile/posts/Posts";
import Followers from "../components/profile/followers/Followers";
import Following from "../components/profile/following/Following";
import ILike from "../components/profile/iLike/ILike";

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
      path: "/inicio",
      name: "auth_home",
      component: Profile
   },

   {
      path: "/:username",
      name: "profile",
      component: Profile,
      children: [
         {
            path: 'publicaciones',
            name: "posts",
            component: Posts
         },
         {
            path: 'seguidores',
            name: "followers",
            component: Followers
         },
         {
            path: 'seguidos',
            name: "following",
            component: Following
         },
         {
            path: 'me_gusta',
            name: "i_like",
            component: ILike
         }
      ]
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
