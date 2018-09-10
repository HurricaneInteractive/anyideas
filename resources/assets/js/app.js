window.axios = require('axios');

import Vue from 'vue';
import router from './routes.js'
import VueCookies from 'vue-cookies'
import App from './App.vue'

Vue.use( VueCookies )

// this.$cookies.isKey("laravel_token")
console.log('window.cookie => ', window.cookie);

// router.beforeEach((to, from, next) => {
//     // const requiresAuth = to.matched.some(record  => record.meta.requiresAuth)
//     // const currentUser = token.content;
//     // console.log('TCL: this.$cookies.get(laravel_token)', this.$cookies.get('anyideas_session'));
//     // console.log('TCL: this.$cookies.get(anyideas_session)', this.$cookies.get("anyideas_session"));
//     console.log('document.cookie => ', document.cookie)
//     if (this.$cookies.isKey("anyideas_session") === undefined ) {
//         next('/login')
//     } else {
//         next()
//     }
//   })

console.log("document.cookie => ", document.cookie.laravel_token);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
