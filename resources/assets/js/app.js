window.axios = require('axios');

import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes.js';
import VueCookie from 'vue-cookie';
import ud_store from './store';
// import './components/global/_globals'
import App from './App.vue';

import storePlugin from './storePlugin'
import LoadingComp from './plugins/loading.js'

import VueAnime from './plugins/vue-anime';
import vueAnime from './plugins/vue-anime';
require('typeface-pt-sans')

Vue.use( Vuex )
Vue.use( VueCookie )
Vue.use( storePlugin )
Vue.use( LoadingComp, { componentName: "loading" } )
Vue.use( VueAnime );

// global components
// <loading/>

router.beforeEach((to, from, next) => {
    // if (to.name !== 'ideas' || to.name !== 'about') {
    //     window.scrollTo(0, 0);
    // }

    console.log('to.path => ', to.name)

    console.log('window.checkAuth => ', window.checkAuth);

    // check if user has logged out 
    // if () {
    //     this.$ud_store.commit('SET_USER_DATA', 'guest');
    //     this.$ud_store.commit('SET_USER_LOGGED_IN', false);
    // }

    // push category parmas to store for use on category page
    if (to.name === 'category') {
        ud_store.commit('SET_CATEGORY_ID', to.params.id );
    }

    if (to.fullPath !== "/login/guest") {
        // if path is NOT /login/guest
        if (typeof ud_store.state.data.user_data !== undefined) {
            console.log('user_data !== undefined => ', ud_store.state)
        }
        if (ud_store.state.data.loggedIn === false) {
            console.log('loggedIn === false => ', ud_store.state)
        }
        
        next();
    } else {
        // alert('welcome to the login page');
        next();
    }

});

router.beforeResolve((to, from, next) => {
    // console.log("3. beforeResolve")
    next();
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    ud_store,
    data: {
        user_data_app: 'placeholder user_data_app string',
        store_data: ud_store.state.data.user_data
    },
    methods: {
        getUserAuth: function() {
            return ud_store.state.data.user_data
        }
    },
    mounted() {
        // console.log("anime => ", anime);
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
