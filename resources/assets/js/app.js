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

import VuejsDialog from 'vuejs-dialog';
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js'; // only needed in custom components
 
// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
import "vue2-editor/dist/vue2-editor.css";
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.bubble.css';
import 'quill/dist/quill.snow.css';
 
// Tell Vue to install the plugin.
Vue.use(VuejsDialog);

Vue.component("home-dashboard", require("./components/admin/HomeDashboard.vue"));

if ($("#homeDashboard").length !== 0) {
    let asideAdmin = new Vue({
        el: "#homeDashboard"
    });
}

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

Vue.component("glosary-list", require("./components/admin/GlosaryList.vue"));

if ($("#glosaryList").length !== 0) {
    const glosaryList = new Vue({
        el: "#glosaryList"
    });
}

Vue.component("acronimo-list", require("./components/admin/AcronimoList.vue"));

if ($("#acronimoList").length !== 0) {
    const acronimoList = new Vue({
        el: "#acronimoList"
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
Vue.component("glosary", require("./components/admin/GlosaryList.vue"));

if ($("#glosaryList").length !== 0) {
    const pageTemplate = new Vue({
        el: "#glosaryList"
    });
}

Vue.component("acronimo", require("./components/admin/AcronimoList.vue"));

if ($("#acronimoList").length !== 0) {
    const pageTemplate = new Vue({
        el: "#acronimoList"
    });
}
Vue.component("menu-list", require("./components/admin/MenuList.vue"));

if ($("#menuList").length !== 0) {
    const menuList = new Vue({
        el: "#menuList"
    });
}

Vue.component("laws-list", require("./components/admin/LawsList.vue"));

if ($("#lawsList").length !== 0) {
    const lawsList = new Vue({
        el: "#lawsList"
    });
}

Vue.component("page-template", require("./views/PageTemplate.vue"));

if ($("#pageTemplate").length !== 0) {
    const pageTemplate = new Vue({
        el: "#pageTemplate"
    });
}

Vue.component("faqs", require("./views/Faqs.vue"));

if ($("#faqs").length !== 0) {
    const faqs = new Vue({
        el: "#faqs"
    });
}

Vue.component("surveys", require("./views/Encuestas.vue"));

if ($("#surveys").length !== 0) {
    const surveys = new Vue({
        el: "#surveys"
    });
}


Vue.component("pregunta-adicional", require("./views/Consulta.vue"));

if ($("#preguntaAdicional").length !== 0) {
    const preguntaAdicional = new Vue({
        el: "#preguntaAdicional"
    });
}


Vue.component("cabecera", require("./components/Cabecera.vue"));

Vue.component("navi", require("./components/Nav.vue"));

Vue.component("navmobile", require("./components/Nav-mobile.vue"));
Vue.component("sidebar", require("./components/Sidebar.vue"));
Vue.component("pie", require("./components/Pie-de-pagina.vue"));
Vue.component("error", require("./components/Error404.vue"));

if ($("#app").length !== 0) {

    let app = new Vue({
        el: "#app"
    });
}
