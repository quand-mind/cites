/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import {
    library
} from "@fortawesome/fontawesome-svg-core";
import {
    fas
} from "@fortawesome/free-solid-svg-icons";
import {
    FontAwesomeIcon
} from "@fortawesome/vue-fontawesome";

library.add(fas);

Vue.component("font-awesome-icon", FontAwesomeIcon);

import BootstrapVue from "bootstrap-vue";

Vue.use(BootstrapVue);

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import {
    TablePlugin
} from "bootstrap-vue";
import {
    ClientTable
} from "vue-tables-2";

Vue.use(TablePlugin);

Vue.use(ClientTable, {}, false, 'bootstrap3', 'default');

Vue.component("aside-admin", require("./components/AsideAdmin.vue"));

if ($("#asideAdmin").length !== 0) {
    let asideAdmin = new Vue({
        el: "#asideAdmin"
    });
}

Vue.component("users-list", require("./components/UsersList.vue"));

if ($("#usersList").length !== 0) {
    let usersList = new Vue({
        el: "#usersList"
    });
}

Vue.component("posts-list", require("./components/PostsList.vue"));

if ($("#postsList").length !== 0) {
    let postsList = new Vue({
        el: "#postsList"
    });
}


Vue.component("post-form", require("./components/PostForm.vue"));

const postForm = new Vue({
    el: "#postForm"
});

Vue.component("questions-list", require("./components/QuestionsList.vue"));

const questionsList = new Vue({
    el: "#questionsList"
});
Vue.component("cabecera", require("./components/Cabecera.vue"));

Vue.component("navi", require("./components/Nav.vue"));

Vue.component("navmobile", require("./components/Nav-mobile.vue"));
Vue.component("sidebar", require("./components/Sidebar.vue"));
Vue.component("pie", require("./components/Pie-de-pagina.vue"));


import VueRouter from 'vue-router'
Vue.use(VueRouter)

if ($("#app").length !== 0) {

    const routes = [{
            path: '/',
            component: require('./views/Home')
        },
        {
            path: '/proyecto/antecedentes-y-justificacion',
            component: require('./views/Proyecto-antecedentes-justificacion')
        },
        {
            path: '/proyecto/acuerdos-internacionales',
            component: require('./views/Proyecto-acuerdos-internacionales')
        },
        {
            path: '/proyecto/legislacion-internacional',
            component: require('./views/Proyecto-legislacion-internacional')
        },
        {
            path: '/proyecto/comision-nacional-de-bioseguridad',
            component: require('./views/Proyecto-comision-nacional-de-bioseguridad')
        },
        {
            path: '/transgenico',
            component: require('./views/Transgenico')
        },
        {
            path: '/noticias',
            component: require('./views/Noticias')
        },
        {
            path: '/faqs-encuestas',
            component: require('./views/Faqs')
        },
        {
            path: '/laboratorio-nacional-ovm',
            component: require('./views/Laboratorio-nacional-ovm')
        },
        {
            path: '/somos/grupos',
            component: require('./views/Somos-grupos')
        },
        {
            path: '/somos/objetivos',
            component: require('./views/Somos-objetivos')
        },
        {
            path: '/somos/mision',
            component: require('./views/Somos-mision')
        },
        {
            path: '/somos/vision',
            component: require('./views/Somos-vision')
        },
        {
            path: '/asociados/nagoya-lumpur',
            component: require('./views/Asociados-nagoya-lumpur')
        },
        {
            path: '/protocolo/mitos-realidades',
            component: require('./views/Protocolo-mitos-realidades')
        },
        {
            path: '/protocolo/ovm-territorio-nacional',
            component: require('./views/Protocolo-ovm-territorio-nacional')
        },
        {
            path: '/protocolo/faqs',
            component: require('./views/Protocolo-faqs')
        },
        {
            path: '/protocolo/recursos',
            component: require('./views/Protocolo-recursos')
        },
        {
            path: '/recursos/ovm-venezuela',
            component: require('./views/Recursos-informacion')
        },
        {
            path: '/recursos/portales',
            component: require('./views/Recursos-portales')
        },
        {
            path: '/recursos/formularios',
            component: require('./views/Recursos-formularios')
        },
        {
            path: '/recursos/mapa-del-sitio',
            component: require('./views/Recursos-mapa-del-sitio')
        },
        {
            path: '/recursos/glosario',
            component: require('./views/Recursos-glosario')
        },
    ];
    const router = new VueRouter({
        mode: 'history',
        routes,
    });

    let app = new Vue({
        el: "#app",
        router
    });
}

// // VUE-SLICK
// import Slick from 'vue-slick';

// new Vue({

//     components: { Slick },

//     data() {
//         return {
//             slickOptions: {
//                 slidesToShow: 3,
//                 // Any other options that can be got from plugin documentation
//             },
//         };
//     },
// });
