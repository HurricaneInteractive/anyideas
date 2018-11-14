window.axios = require('axios')

import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes.js';
import ud_store from './store';
import VueClipboard from 'vue-clipboard2'
import App from './App.vue';
import vSelect from 'vue-select'
import InputTag from 'vue-input-tag'
import Fragment from 'vue-fragment'

import storePlugin from './storePlugin'

// import VueAnime from './plugins/vue-anime';
import capitalise from './plugins/capitalise';
import classNames from './plugins/classNames';

import RegiserGlobals from './global/registerGlobals'
import RegisterBase from './base/registerBase'

// Defines Custom Global Components
RegiserGlobals()
RegisterBase()

Vue.use( Vuex )
Vue.use( storePlugin )
// Vue.use( VueAnime )
Vue.use( capitalise )
Vue.use( VueClipboard )
Vue.use( classNames )
Vue.use( Fragment.Plugin )

Vue.component('input-tag', InputTag)
Vue.component('v-select', vSelect)

router.beforeEach((to, from, next) => {
    let user = ud_store.state.data.user_data,
        window_auth = window.checkAuth

    if (typeof window_auth !== 'undefined' && user === null) {
        ud_store.commit('SET_USER_DATA', window_auth)
        ud_store.commit('SET_USER_LOGGED_IN', true)
    }

    // This only seems to fire on load which is interesting...
    if (to.name === 'login') {
        let state_user = ud_store.state.data.user_data
        if (state_user !== null) {
            router.push({ name: 'index' })
        }
    }

    // push category parmas to store for use on category page
    if (to.name === 'category') {
        ud_store.commit('SET_CATEGORY_ID', to.params.id );
    }

    next();
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    ud_store,
    methods: {
        getUserAuth: function() {
            return ud_store.state.data.user_data
        }
    },
    computed: {
        store_data() {
            return ud_store.getters.getUserData
        }
    }
});
