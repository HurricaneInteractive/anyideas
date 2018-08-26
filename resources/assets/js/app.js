import Vue from 'vue'
import VueRouter from 'vue-router'
// import lodash from 'lodash'
// import marked from 'marked'

Vue.use(VueRouter)

import App from './App.vue'
import Home from './views/Home'
import Login from './views/Login'
import Register from './views/Register'
import AddNewIdea from './views/AddNewIdea'
import IdeaPage from './views/IdeaPage'

require('./bootstrap');
window.Vue = require('vue');

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/add-new-idea',
            name: 'add-new-idea',
            component: AddNewIdea
        },
        {
            path: '/idea-view',
            name: 'idea-view',
            component: IdeaPage
        }
        // add more pages here
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
