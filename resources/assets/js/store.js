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
            user_data: null,
            loggedIn: false
        },
        // idea: {
        //     id: '',
        //     title: '',
        //     status: '',
        //     category: '',
        //     tags: '',
        //     description: '',
        // },
        current_page_idea: {
            user_id: '0',
            data: {},
            description: 'default val',
            timeline: {},
            updates: {},
            discussion: {},
        },
        current_search: {},
        current_category_id: '',
        consoleLog: {
            component: ["background: rgb(11, 11, 13)", "color: rgb(66,185,131)", "border: 1px solid rgb(66,185,131)", "padding: 4px 24px 4px 16px", "line-height: 24px"].join(";"),
        },
        current_user_view: null,
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

        SET_IDEA_DATA(state, newValue) {
            if (this.debug) console.log('SET_IDEA_ID triggered with', newValue)
            state.current_page_idea.data = newValue;
        },

        SET_IDEA_DESCRIPTION(state, newValue) {
            if (this.debug) console.log('SET_IDEA_DESCRIPTION triggered with', newValue)
            state.current_page_idea.description = newValue;
        },

        SET_IDEA_USER_ID(state, newValue) {
            if (this.debug) console.log('SET_IDEA_USER_ID triggered with', newValue)
            state.current_page_idea.user_id = newValue;
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
        },
        SET_CURRENT_USER_META(state, payload) {
            state.current_user_view.user[payload.key] = payload.value
        },
        SET_CURRENT_USER_INTERESTS(state, interests) {
            state.current_user_view.interests = interests
        },
        SET_CURRENT_USER_BIO(state, bio) {
            state.current_user_view.user_meta.bio = bio
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
        },
        getUserData: (state) => state.data.user_data,
        getLoggedInState: (state) => state.data.loggedIn,
        getCurrentIdea: (state) => state.current_page_idea,
        getCurrentIdeaUserId: (state) => state.current_page_idea.user_id,
        getCurrentIdeaDescription: (state) => state.current_page_idea.description
    }
  })