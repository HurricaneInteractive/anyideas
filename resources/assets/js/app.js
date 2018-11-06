window.axios = require('axios')

import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes.js';
import ud_store from './store';
import VueClipboard from 'vue-clipboard2'
import App from './App.vue';
import vSelect from 'vue-select'
import InputTag from 'vue-input-tag'

import storePlugin from './storePlugin'
import LoadingComp from './plugins/loading.js'
import NoIdeasComp from './plugins/noideas.js'

import VueAnime from './plugins/vue-anime';
import capitalise from './plugins/capitalise';

Vue.use( Vuex )
// Vue.use( VueCookie )
Vue.use( storePlugin )
Vue.use( LoadingComp, { componentName: "loading" } )
Vue.use( NoIdeasComp, { componentName: "noideas" } )
Vue.use( VueAnime );
Vue.use( capitalise );
Vue.use( VueClipboard );

Vue.component('input-tag', InputTag)
Vue.component('v-select', vSelect)

// global components
// <loading/>

// global plugins (add 'this.$' to use in Vue)
// ud_store
// anime
// capitalise

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
    data: {
        user_data_app: 'placeholder user_data_app string',
        // store_data: ud_store.state.data.user_data
    },
    methods: {
        getUserAuth: function() {
            return ud_store.state.data.user_data
        }
    },
    mounted() {
        // console.log("anime => ", anime);
    },
    computed: {
        store_data() {
            return ud_store.getters.getUserData
        }
    }
});