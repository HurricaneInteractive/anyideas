import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        current_user: null,
        page_data: {
            user_profile: null,
            idea: null
        }
    },
    mutations: {
        set__currentUser(state, payload) {
            state.current_user = payload
        },
        set__pageData(state, payload) {
            state[payload.key] = payload.data
        }
    },
    getters: {
        get__currentUser: (state) => state.current_user,
        get__pageData: (state) => (key) => {
            if (state.page_data.hasOwnProperty(key)) {
                return state.page_data[key]
            }

            return null
        }
    }
});