import Vuex from 'vuex'
import Vue from 'vue';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user_data: {
            name: 'guest'
        }
    },
    mutations: {
        SET_USER_DATA(state, newValue) {
            state.user_data = newValue;
            console.log('2. mutations - store = new Vuex.Store')
            // console.log('STORE MUTATIONS: this.state', state.user_data);
            // console.log('STORE MUTATIONS: newValue', newValue);
            if (this.debug) console.log('setUserData triggered with', newValue)
            // this.state.user_data = newValue;
        },
        clear_user_data(state) {
            if (this.debug) console.log('STORE MUTATIONS: clearUserData triggered -> ') 
            state.user_data = ''
        }
    }
  })