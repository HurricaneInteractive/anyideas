window.axios = require('axios');

import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes.js';
import VueCookie from 'vue-cookie';
import ud_store from './store';
// import './components/global/_globals'
import App from './App.vue';
import vSelect from 'vue-select'
import InputTag from 'vue-input-tag'

import storePlugin from './storePlugin'
import LoadingComp from './plugins/loading.js'

import VueAnime from './plugins/vue-anime';
import capitalise from './plugins/capitalise';
require('typeface-pt-sans')

Vue.use( Vuex )
Vue.use( VueCookie )
Vue.use( storePlugin )
Vue.use( LoadingComp, { componentName: "loading" } )
Vue.use( VueAnime );
Vue.use( capitalise );

Vue.component('input-tag', InputTag)
Vue.component('v-select', vSelect)

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