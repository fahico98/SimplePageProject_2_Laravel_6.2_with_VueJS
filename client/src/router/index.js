
import Vue from "vue";
import VueRouter from "vue-router";

import Home from "../views/Home";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import Profile from "../views/profile/Profile";
import View404 from "../views/View404";

import Posts from "../components/profile/posts/Posts";
import ILike from "../components/profile/iLike/ILike";
import FollowingBaseComponent from "../components/profile/followersFollowing/FollowingBaseComponent";
// import Followers from "../components/profile/followers/Followers";
// import Following from "../components/profile/following/Following";

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
            component: FollowingBaseComponent
         },
         {
            path: 'seguidos',
            name: "followed",
            component: FollowingBaseComponent
         },
         {
            path: 'me_gusta',
            name: "i_like",
            component: ILike
         },
         {
            path: "",
            redirect: {name: "posts"}
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
