window.axios = require('axios');

import Vue from 'vue';
import router from './routes.js'
import VueCookie from 'vue-cookie'
import App from './App.vue'

Vue.use( VueCookie )

router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0);
    if (to.fullPath !== "/login") {
        if (app.user_data === 'guest') {
            axios.post('/ai/user/get/current').then(response => {       
                console.log('TCL: response', response);
                console.log('TCL: app.user_data before', app.user_data);
                app.user_data = response.data.user;
                console.log('TCL: app.user_data after', app.user_data);
                next();
            }).catch(error => {
                console.log('TCL: error', error);
                router.push('/login');
            })
        } else {
            console.log('run else - didnt make an axios req')
            console.log('app.user_data => ', app.user_data)
            next()
        }
    }
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    data: function () {
        return {
            user_data: 'guest'
        }
    }
});

