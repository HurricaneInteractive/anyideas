import Vuex from 'vuex'
import Vue from 'vue';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        data: {
            user_data: 'guest',
            loggedIn: false
        }
    },
    mutations: {
        SET_USER_DATA(state, newValue) {
            // state.data.user_data = newValue;
            console.warn('STORE MUTATIONS: state', state.data);
            if (this.debug) console.log('setUserData triggered with', newValue)
            this.state.data.user_data = newValue;
        },
        SET_USER_LOGGED_IN(state, newValue) {
            if (this.debug) console.log('setUserData triggered with', newValue)
            this.state.data.loggedIn = newValue;
        },
        CLEAR_USER_DATA(state) {
            if (this.debug) console.log('STORE MUTATIONS: clearUserData triggered -> ') 
            this.state.data.user_data = '';
            this.state.data.loggedIn = false;
        }
    }
  })