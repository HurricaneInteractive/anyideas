import Vuex from 'vuex'
import Vue from 'vue';
import icons from './data/icons'
import categories from './data/categories'
import svgBackground from './data/svgBackground'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        data: {
            user_data: 'guest',
            loggedIn: false
        },
        idea: {
            id: '',
            title: '',
            status: '',
            category: '',
            tags: '',
            description: '',
        },
        icons: icons,
        categories: categories,
        svgBackground: svgBackground,
    },
    mutations: {
        SET_USER_DATA(state, newValue) {
            // state.data.user_data = newValue;
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
        },

        SET_IDEA_ID(state, newValue) {
            if (this.debug) console.log('SET_IDEA_ID triggered with', newValue)
            this.state.idea.id = newValue;
        },

        SET_IDEA_DARTS(state, newValue) {
            if (this.debug) console.log('SET_IDEA_DARTS triggered with', newValue)
            this.state.idea.darts = newValue.darts;
        },

        SET_IDEA_DESCRIPTION(state, newValue) {
            if (this.debug) console.log('SET_IDEA_DESCRIPTION triggered with', newValue)
            this.state.idea.description = newValue;
        },
        CLEAR_IDEA(state) {
            if (this.debug) console.log('CLEAR_IDEA triggered with', newValue)
            this.state.idea.id = '';
            this.state.idea.description = '';
        }
    }
  })