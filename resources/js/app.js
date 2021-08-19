/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using V   ue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

import datatable from "datatables.net-responsive-bs4";
import swal from "sweetalert";

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/plan', component: require('./components/Plan.vue').default },

    { path: '/categoria', component: require('./components/Categoria/Categoria.vue').default },
    { path: '/categoria', component: require('./components/Categoria/Categoria.vue').default },
    { name: 'categoria', path: '/categoria/:id', component: require('./components/Categoria/SubCategoria.vue').default },
    { name: 'influencer', path: '/sponsor/influencer', component: require('./components/Sponsor/Influencer.vue').default },
    { name: 'empresa', path: '/sponsor/empresa', component: require('./components/Sponsor/Empresa.vue').default },
    { path: '/ongs', component: require('./components/Ong/Ong.vue').default },
]

const router = new VueRouter({
    routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({

    el: '#app',
    router
});
