window.axios = require('axios');

import Vue from 'vue';
import Vuex, { mapState } from 'vuex'
import router from './routes.js'
import VueCookie from 'vue-cookie'
import App from './App.vue'
import store from './store'

Vue.use( Vuex )
Vue.use( VueCookie )

// router.beforeEach((to, from, next) => {
//     console.log('1. beforeEach')
// });

// router.beforeResolve((to, from, next) => {
//     console.log('3. beforeResolve')
// });

// router.beforeEach((to, from, next) => {
//     console.log('2. beforeResolve');
//     window.scrollTo(0, 0);
//     console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);
//     console.warn('pls run');
//     if (to.fullPath === "/login") {
//         axios.post('/ai/user/get/current').then(response => {       
//             console.log('axios response.data.user =>', response.data.user);
//             let reponse_data = response.data.user;
//             store.commit('set_user_data', reponse_data);
//             // store.set_user_data(response.data.user)
//             next();
//         }).catch(error => {
//             console.error('ROUTER BEFOREEACH: error', error);
//             next()
//         })
//     }
//     else {
//         console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);
//         if (store.state.user_data.name === 'cheese') {
//             axios.post('/ai/user/get/current').then(response => {       
//                 // console.log('axios response.data.user =>', response.data.user);
//                 // store.set_user_data(response.data.user)
//                 let reponse_data = response.data.user;
//                 store.commit('set_user_data', reponse_data);
//                 console.log('TCL: reponse_data', reponse_data);
//                 next();
//             }).catch(error => {
//                 console.log('ROUTER BEFOREEACH: error', error);
//                 router.push('/login');
//             })
//         }
//         next();
//     }
// });

router.beforeEach((to, from, next) => {
    console.log('2. beforeResolve');
    window.scrollTo(0, 0);
    console.warn('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data);

    axios.post('/ai/user/get/current').then(response => {
        console.assert('we ran boiz')     
        console.log('axios response.data.user =>', response.data.user);
        let response_data = response.data.user;
        store.commit('SET_USER_DATA', response_data);
        
        console.warn("AXIOS BEFORE store.user_data => ", store.state.user_data)
        console.log("AXIOS BEFORE app.user_data_app => ", app.user_data_app)
        app.user_data_app = response_data;
        console.log("AXIOS AFTER app.user_data_app => ", app.user_data_app)
        // store.SET_USER_DATA(response.data.user)
        next();
    }).catch(error => {
        console.error('ROUTER BEFOREEACH: error', error);
        next()
    })
});

router.beforeResolve((to, from, next) => {
    console.log("3. beforeResolve")
    console.warn("BEFORE RESOLVE app.user_data_app => ", app.user_data_app)
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

