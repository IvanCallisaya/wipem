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
import VueMeta from 'vue-meta'
import VueRouter from 'vue-router'

import VueCountryCode from "vue-country-code-select";
import VueSocialSharing from 'vue-social-sharing'

Vue.use(VueSocialSharing);

Vue.use(VueCountryCode);

Vue.use(VueRouter);
Vue.use(VueFroala);
Vue.use(LoadScript);
Vue.use(VueMeta)

Vue.mixin({
    methods: {
        convertToSlug(text) {
            {
                text = text.toString().toLowerCase().trim();

                const sets = [
                    { to: "a", from: "[ÀÁÂÃÄÅÆĀĂĄẠẢẤẦẨẪẬẮẰẲẴẶἀ]" },
                    { to: "c", from: "[ÇĆĈČ]" },
                    { to: "d", from: "[ÐĎĐÞ]" },
                    { to: "e", from: "[ÈÉÊËĒĔĖĘĚẸẺẼẾỀỂỄỆ]" },
                    { to: "g", from: "[ĜĞĢǴ]" },
                    { to: "h", from: "[ĤḦ]" },
                    { to: "i", from: "[ÌÍÎÏĨĪĮİỈỊ]" },
                    { to: "j", from: "[Ĵ]" },
                    { to: "ij", from: "[Ĳ]" },
                    { to: "k", from: "[Ķ]" },
                    { to: "l", from: "[ĹĻĽŁ]" },
                    { to: "m", from: "[Ḿ]" },
                    { to: "n", from: "[ÑŃŅŇ]" },
                    { to: "o", from: "[ÒÓÔÕÖØŌŎŐỌỎỐỒỔỖỘỚỜỞỠỢǪǬƠ]" },
                    { to: "oe", from: "[Œ]" },
                    { to: "p", from: "[ṕ]" },
                    { to: "r", from: "[ŔŖŘ]" },
                    { to: "s", from: "[ßŚŜŞŠȘ]" },
                    { to: "t", from: "[ŢŤ]" },
                    { to: "u", from: "[ÙÚÛÜŨŪŬŮŰŲỤỦỨỪỬỮỰƯ]" },
                    { to: "w", from: "[ẂŴẀẄ]" },
                    { to: "x", from: "[ẍ]" },
                    { to: "y", from: "[ÝŶŸỲỴỶỸ]" },
                    { to: "z", from: "[ŹŻŽ]" },
                    { to: "-", from: "[·/_,:;']" },
                ];

                sets.forEach((set) => {
                    text = text.replace(new RegExp(set.from, "gi"), set.to);
                });

                return text
                    .replace(/\s+/g, "-") // Replace spaces with -
                    .replace(/[^-a-zа-я\u0370-\u03ff\u1f00-\u1fff]+/g, "") // Remove all non-word chars
                    .replace(/--+/g, "-") // Replace multiple - with single -
                    .replace(/^-+/, "") // Trim - from start of text
                    .replace(/-+$/, ""); // Trim - from end of text
            }
        },
    }
});

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
Vue.component('whatsapp', require('./components/Whatsapp.vue').default);


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
