window.axios = require('axios');

import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes.js';
import VueCookie from 'vue-cookie';
import App from './App.vue';
import store from './store';
import axios from 'axios';
import storePlugin from './storePlugin'

Vue.use( Vuex )
Vue.use( VueCookie )
Vue.use( storePlugin )

router.beforeEach((to, from, next) => {
    console.log('2. beforeResolve');
    console.log('to.fullPath =>', to.fullPath)
    window.scrollTo(0, 0);
    console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data);

    if (to.fullPath !== "/login/guest") {
        
        let user_name = "guest";
        console.log('TCL: user_name ', user_name );
        console.log('store.state.user_data =>', store.state.user_data);
        if (typeof store.state.user_data !== undefined && typeof store.state.user_data.name !== undefined) {
            console.log('store.state => ', store.state)
            console.log('store.state.user_data => ', store.state.user_data)
            console.log('store.state.user_data.name => ', store.state.user_data.name)
            user_name = store.state.user_data.name
        }

        // console.log('just a guest')
        // axios.post('/ai/user/get/current').then(response => {
        //     console.assert('we ran boiz')     
        //     console.log('axios response.data.user =>', response.data.user);
        //     store.commit('SET_USER_DATA', response.data.user);
        //     // store.SET_USER_DATA(response.data.user)
        //     next();
        // }).catch(error => {
        //     console.error('ROUTER BEFOREEACH: error', error);
        //     next()
        // })
        next();
    } else {
        alert('welcome to the login page');
        next();
    }

});

router.beforeResolve((to, from, next) => {
    console.log("3. beforeResolve")
    next();
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
    data: {
        user_data_app: 'placeholder user_data_app string',
        store_data: store.state.user_data
    },
    methods: {
        getUserAuth: function() {
            return this.this.user_data_app
        }
    }
});

















// router.beforeEach((to, from, next) => {
//     console.log('2. beforeResolve');
//     window.scrollTo(0, 0);
//     console.log("to.fullPath => ", to.fullPath)
//     console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);
//     if (to.fullPath === "/login") {
//         console.log('apparently we"re on the login page')
//         if (store.state.user_data.name === 'guest') {
//             console.warn('run if user is guest')
//             axios({
//                 method: 'POST',
//                 url: '/ai/user/get/current'
//             })
//             .then(response => {
//                 console.log('TCL: response', response);
//                 console.log('TCL: response', response.data);
//                 console.log('TCL: response', response.data.user);
//             })
//             .catch(error => {
//                 console.error(error);
//             });

//         } else {
//             console.warn('ran else')
//             next()
//         }
//     }
//     if (store.state.user_data.name === 'guest') {
//         axios.post('/ai/user/get/current').then(response => {
//             console.log('TCL: response', response);
//             console.log('TCL: response', response.data);
//             console.log('TCL: response', response.data.user);
            
//             store.commit('SET_USER_DATA', response.data.user);
//             next();
//         }).catch(error => {
//             console.error('ROUTER BEFOREEACH: error', error);
//             next()
//         })
//     }
// });

// if (to.fullPath === "/login") {
//     axios.post('/ai/user/get/current').then(response => {
//         store.commit('SET_USER_DATA', response.data.user);
//         next();
//     }).catch(error => {
//         console.error('ROUTER BEFOREEACH: error', error);
//         next()
//     })
// }
// else {
//     console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);
//     if (store.state.user_data.name === 'guest') {
//         axios.post('/ai/user/get/current').then(response => {
//             store.commit('SET_USER_DATA', response.data.user);
//             next();
//         }).catch(error => {
//             console.error('ROUTER BEFOREEACH: error', error);
//             next()
//         })
//     }
//     next();
// }
