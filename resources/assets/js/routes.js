import Vue from 'vue'
import VueRouter from 'vue-router'
import VueCookies from 'vue-cookies'


Vue.use( VueRouter )
Vue.use( VueCookies )


const routes = [
  {
    path: '/',
    name: 'home',
    component: Vue.component( 'Home', require( './views/Home.vue' ) ),
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    name: 'login',
    component: Vue.component( 'Login', require( './views/Login.vue' ) )
  },
  {
    path: '/register',
    name: 'register',
    component: Vue.component( 'Register', require( './views/Register.vue' ) )
  },
  {
    path: '/add-new-idea',
    name: 'add-new-idea',
    component: Vue.component( 'Cafe', require( './views/AddNewIdea.vue' ) )
  },
  {
    path: '/idea-view',
    name: 'idea-view',
    component: Vue.component( 'IdeaPage', require( './views/IdeaPage.vue' ) )
  },
  {
    path: '/idea/:id',
    name: 'idea',
    component: Vue.component( 'IndividualIdea', require( './views/IndividualIdea.vue' ) )
  },
  {
    path: '/user/:id',
    name: 'user',
    component: Vue.component( 'UserPage', require( './views/UserPage.vue' ) )
  },
];
// routes here
const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;