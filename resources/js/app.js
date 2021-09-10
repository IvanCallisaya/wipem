/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using V   ue and Laravel.
 */

require('./bootstrap');
require('admin-lte');


import datatable from "datatables.net-responsive-bs4";
import swal from "sweetalert";
//Import Froala Editor 
import 'froala-editor/js/plugins.pkgd.min.js';
//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import LoadScript from 'vue-plugin-load-script';
// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';



// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'


window.Vue = require('vue').default;

import VueRouter from 'vue-router'

import VueCountryCode from "vue-country-code-select";
Vue.use(VueCountryCode);

Vue.use(VueRouter);
Vue.use(VueFroala);
Vue.use(LoadScript);



let routes = [
    { path: '/principal', component: require('./admin/imagenes/Principal.vue').default },
    { path: '/causas', component: require('./admin/imagenes/Causas.vue').default },
    { path: '/proyectoImages', component: require('./admin/imagenes/ProyectoImagenes.vue').default },
    { path: '/plan', component: require('./admin/Plan/Plan.vue').default },
    { path: '/categoria', component: require('./admin/Categoria/Categoria.vue').default },
    { name: 'categoria', path: '/categoria/:id', component: require('./admin/Categoria/SubCategoria.vue').default },
    { name: 'influencer', path: '/sponsor/influencer', component: require('./admin/Sponsor/Influencer.vue').default },
    { path: '/proyectos', component: require('./admin/Proyecto/Proyecto.vue').default },
    { path: '/proyecto/nuevo', component: require('./admin/Proyecto/Nuevo.vue').default },
    { name: 'proyectoEdit', path: '/proyecto/:id', component: require('./admin/Proyecto/Edit.vue').default },
    { name: 'proyectoDetalle', path: '/proyecto/:id', component: require('./admin/Proyecto/Detalle.vue').default },
    { name: 'empresa', path: '/sponsor/empresa', component: require('./admin/Sponsor/Empresa.vue').default },
    { path: '/ongs', component: require('./admin/Ong/Ong.vue').default },
]

Vue.component('imagenes', require('./components/ImagenesIndex.vue').default);
Vue.component('imagenes-causas', require('./components/ImagenesCausas.vue').default);
Vue.component('imagenes-proyecto', require('./components/ImagenesProyecto.vue').default);
Vue.component('causa-carrusel', require('./components/CausasCarousel.vue').default);
Vue.component('empresa-carrusel', require('./components/EmpresasCarrusel.vue').default);
Vue.component('categorias', require('./components/Categorias.vue').default);
Vue.component('causas', require('./components/Causas.vue').default);
Vue.component('proyecto', require('./components/Proyecto.vue').default);
Vue.component('influencer', require('./components/Influencer.vue').default);
Vue.component('registrar', require('./components/Registrar.vue').default);


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
