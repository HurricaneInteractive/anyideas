window.axios = require('axios');

import Vue from 'vue';
import Vuex, { mapState } from 'vuex'
import router from './routes.js'
import VueCookie from 'vue-cookie'
import App from './App.vue'

Vue.use( Vuex )
Vue.use( VueCookie )

// var store = {
//     debug: true,
//     state: {
//         user_data: 'guest'
//     },
//     setUserData (newValue) {
//       if (this.debug) console.log('setUserData triggered with', newValue)
//       this.state.user_data = newValue
//     },
//     clearUserData () {
//       if (this.debug) console.log('clearUserData triggered')
//       this.state.user_data = ''
//     }
// }

router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0);
    console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);

    if (to.fullPath === "/login") {
        axios.post('/ai/user/get/current').then(response => {       
            console.log('axios response.data.user =>', response.data.user);
            let reponse_data = response.data.user;
            store.commit('set_user_data', reponse_data);
            // store.set_user_data(response.data.user)
            next();
        }).catch(error => {
            console.error('ROUTER BEFOREEACH: error', error);
            next()
        })
    }
    else {
        console.log('ROUTER BEFOREEACH: store.state.user_data.name', store.state.user_data.name);
        if (store.state.user_data.name === 'cheese') {
            axios.post('/ai/user/get/current').then(response => {       
                // console.log('axios response.data.user =>', response.data.user);
                // store.set_user_data(response.data.user)
                let reponse_data = response.data.user;
                store.commit('set_user_data', reponse_data);
                next();
            }).catch(error => {
                console.log('ROUTER BEFOREEACH: error', error);
                router.push('/login');
            })
        }
        next();
    }
});

const store = new Vuex.Store({
    state: {
        user_data: {
            name: 'guest',
            email: 'not@not.com'
        }
    },
    mutations: {
        // increment: state => state.count++,
        // decrement: state => state.count--,
        set_user_data(state, newValue) {
            console.log('STORE MUTATIONS: this.state', state);
            console.log('STORE MUTATIONS: newValue', newValue);
            if (this.debug) console.log('setUserData triggered with', newValue)
            // app.state.user_data = newValue
            this.state.user_data = newValue;
            console.log('STORE MUTATIONS: set_user_data -> this.state.user_data', this.state.user_data);
        },
        clear_user_data(state) {
            if (this.debug) console.log('STORE MUTATIONS: clearUserData triggered -> ') 
            state.user_data = ''
        }
    }
  })

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    data: {
        user_data_app: 'placeholder user_data_app string',
        store_data: store.state.user_data
    },
    mounted() {
        console.log('MOUNTED: set_user_data -> store.state.user_data =>', store.state.user_data);
        // console.log('TCL: set_user_data -> this.user_data => ', this.user_data);
        return this.user_data_app = store.state.user_data
    },
    computed() {
        console.log('COMPUTED: set_user_data -> store.state.user_data =>', store.state.user_data);
        return this.user_data_app = store.state.user_data
    }
});

