import Vuex from 'vuex'
import Vue from 'vue';

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user_data: {
            name: 'placehold-me'
        }
    },
    mutations: {
        // increment: state => state.count++,
        // decrement: state => state.count--,
        SET_USER_DATA(state, newValue) {
            state = state;
            console.log('2. mutations - store = new Vuex.Store')
            console.log('STORE MUTATIONS: this.state', state);
            console.log('STORE MUTATIONS: newValue', newValue);
            if (this.debug) console.log('setUserData triggered with', newValue)
            // app.state.user_data = newValue
            this.state.user_data = newValue;
            console.log('STORE MUTATIONS: SET_USER_DATA -> this.state.user_data',
                this.state.user_data);
        },
        clear_user_data(state) {
            if (this.debug) console.log('STORE MUTATIONS: clearUserData triggered -> ') 
            state.user_data = ''
        }
    }
  })

  export default store