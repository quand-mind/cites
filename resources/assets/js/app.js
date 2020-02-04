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
import "slick-carousel/slick/slick.css";

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

Vue.component("aside-admin", require("./components/admin/AsideAdmin.vue"));

if ($("#asideAdmin").length !== 0) {
    let asideAdmin = new Vue({
        el: "#asideAdmin"
    });
}

Vue.component("users-list", require("./components/admin/UsersList.vue"));

if ($("#usersList").length !== 0) {
    let usersList = new Vue({
        el: "#usersList"
    });
}

Vue.component("posts-list", require("./components/admin/PostsList.vue"));

if ($("#postsList").length !== 0) {
    let postsList = new Vue({
        el: "#postsList"
    });
}


Vue.component("post-form", require("./components/admin/PostForm.vue"));

if ($("#postForm").length !== 0) {
    const postForm = new Vue({
        el: "#postForm"
    });
}

Vue.component("questions-list", require("./components/admin/QuestionsList.vue"));

if ($("#questionsList").length !== 0) {
    const questionsList = new Vue({
        el: "#questionsList"
    });
}

Vue.component("surveys-list", require("./components/admin/SurveysList.vue"));

if ($("#surveysList").length !== 0) {
    const surveysList = new Vue({
        el: "#surveysList"
    });
}

Vue.component("pages-list", require("./components/admin/PagesList.vue"));

if ($("#pagesList").length !== 0) {
    const pagesList = new Vue({
        el: "#pagesList"
    });
}

Vue.component("page-form", require("./components/admin/PageForm.vue"));

if ($("#pageForm").length !== 0) {
    const pageForm = new Vue({
        el: "#pageForm"
    });
}

Vue.component("page-template", require("./views/PageTemplate.vue"));

if ($("#pageTemplate").length !== 0) {
    const pageTemplate = new Vue({
        el: "#pageTemplate"
    });
}

Vue.component("cabecera", require("./components/Cabecera.vue"));

Vue.component("navi", require("./components/Nav.vue"));

Vue.component("navmobile", require("./components/Nav-mobile.vue"));
Vue.component("sidebar", require("./components/Sidebar.vue"));
Vue.component("pie", require("./components/Pie-de-pagina.vue"));
Vue.component("error", require("./components/Error404.vue"));


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
            path: '/proyecto/legislacion',
            component: require('./views/Proyecto-legislacion')
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
            path: '/preguntas-frecuentes',
            component: require('./views/Faqs')
        },
        {
            path: '/encuestas',
            component: require('./views/Encuestas')
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
            path: '/protocolo/',
            component: require('./views/Protocolo')
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
            path: '/protocolo/preguntas-frecuentes',
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
        }
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
