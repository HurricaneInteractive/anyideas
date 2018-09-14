window.axios = require('axios');

import Vue from 'vue';
import router from './routes.js'
import VueCookie from 'vue-cookie'
import App from './App.vue'

Vue.use( VueCookie )

router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0);
    if (to.fullPath !== "/login") {
        axios.post('/ai/user/get/current').then(response => {       
            console.log('TCL: response', response);
            next();
        }).catch(error => {
            console.log('TCL: error', error);
            router.push('/login');
        })
    } else{
        next();
    }
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    beforeCreate: function() {
        console.log('beforeCreate function');
    },
    beforeMount: function() {
        console.log('beforeMount function');
    }
});
