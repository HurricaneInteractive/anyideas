window.axios = require('axios');

import Vue from 'vue';
import router from './routes.js'
import VueCookie from 'vue-cookie'
import App from './App.vue'

Vue.use( VueCookie )

// this.$cookies.isKey("laravel_token")
console.log('window.cookie => ', window.cookie);
// console.log('anyideas_session => ',this.$cookie.get('anyideas_session'));

router.beforeEach((to, from, next) => {
    // const requiresAuth = to.matched.some(record  => record.meta.requiresAuth)
    // const currentUser = token.content;
    // console.log('TCL: this.$cookies.get(laravel_token)', this.$cookies.get('anyideas_session'));
    // console.log('TCL: this.$cookies.get(anyideas_session)', this.$cookies.get("anyideas_session"));
    // console.log('document.cookie => ', document.cookie)
    // if (this.$cookies.isKey("anyideas_session") === undefined ) {
    //     next('/login')
    // } else {
    //     next()
    // }
    // console.log('to, from, next => ', to, from, next);
    console.log('run beforeEach');
    next();
  })

console.log("document.cookie.laravel_token => ", document.cookie.laravel_token);
console.log("document.cookie.anyideas_session => ", document.cookie.anyideas_session);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
