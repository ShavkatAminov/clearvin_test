/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'
import store from "./store";

Vue.use(Router)

const router = new Router({
    base: process.env.BASE_URL,
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes: [
        {
            path: '/',
            name: 'vehicleType',
            component: () => import('./components/VehicleType.vue')
        },

        {
            path: '/makes/:type',
            name: 'makesOfType',
            component: () => import('./components/Make.vue')
        }
    ],
})
export default router