import Vuex from 'vuex'
import Vue from 'vue';
import icons from './data/icons'
import categories from './data/categories'
import status from './data/status'
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
        current_search: {},
        current_category_id: '',
        consoleLog: {
            component: ["background: rgb(11, 11, 13)", "color: rgb(66,185,131)", "border: 1px solid rgb(66,185,131)", "padding: 4px 24px 4px 16px", "line-height: 24px"].join(";"),
        },
        current_user_view: {},
        current_user_ideas: null,
        icons: icons,
        categories: categories,
        status: status,
        svgBackground: svgBackground,
    },
    mutations: {
        SET_USER_DATA(state, newValue) {
            // state.data.user_data = newValue;
            console.log('SET_USER_DATA', newValue)
            if (this.debug) console.log('setUserData triggered with', newValue)
            state.data.user_data = newValue;
        },
        SET_USER_LOGGED_IN(state, newValue) {
            console.log('SET_USER_LOGGED_IN', newValue)
            if (this.debug) console.log('setUserData triggered with', newValue)
            state.data.loggedIn = newValue;
        },
        CLEAR_USER_DATA(state) {
            if (this.debug) console.log('STORE MUTATIONS: clearUserData triggered -> ') 
            state.data.user_data = '';
            state.data.loggedIn = false;
        },

        SET_IDEA_ID(state, newValue) {
            if (this.debug) console.log('SET_IDEA_ID triggered with', newValue)
            state.idea.id = newValue;
        },

        SET_IDEA_DARTS(state, newValue) {
            if (this.debug) console.log('SET_IDEA_DARTS triggered with', newValue)
            state.idea.darts = newValue.darts;
        },

        SET_IDEA_DESCRIPTION(state, newValue) {
            if (this.debug) console.log('SET_IDEA_DESCRIPTION triggered with', newValue)
            state.idea.description = newValue;
        },
        CLEAR_IDEA(state) {
            if (this.debug) console.log('CLEAR_IDEA triggered with', newValue)
            state.idea.id = '';
            state.idea.description = '';
        },

        SET_CURRENT_SEARCH(state, newValue) {
            if (this.debug) console.log('SET_CURRENT_SEARCH triggered with', newValue)
            console.error('newValue => ', newValue)
            state.current_search = newValue;
        },
        CLEAR_CURRENT_SEARCH(state) {
            if (this.debug) console.log('CLEAR_CURRENT_SEARCH triggered with', newValue)
            state.current_search = '';
        },

        SET_CATEGORY_ID(state, newValue) {
            if (this.debug) console.log('SET_CATEGORY_ID triggered with', newValue)
            state.current_category_id = newValue;
        },

        SET_CURRENT_USER_DATA(state, newValue) {
            if (this.debug) console.log('SET_CURRENT_USER_DATA triggered with', newValue)
            state.current_user_view = newValue;
        },
        SET_CURRENT_USER_IDEAS(state, newValue) {
            console.log('SET_CURRENT_USER_DATA triggered with', newValue)
            state.current_user_ideas = newValue;
        }
    },
    getters: {
        getUserIdeas: (state) => state.current_user_ideas,
        getUserMeta: (state) => state.current_user_view,
        getUserIdeasCount: (state) => {
            if (state.current_user_ideas === null) {
                return 0
            }
            else {
                return Object.keys(state.current_user_ideas).length
            }
        }
    }
  })