<!-- App.vue acts as a wrapper for the whole application -->
<!-- use this.$ud_store in child components -->
<template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">any.ideas v1</router-link>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!user_id">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!user_id">Register</router-link>
                            <router-link :to="{ name: 'add-new-idea' }" class="nav-link" v-if="user_id">Add New Idea</router-link>
                            <li class="nav-link" v-if="user_id"> Hi, <router-link :to="'user/' + user_id" class="nav-link">{{name}}</router-link></li>
                            <form method="POST" action="/logout" class="nav-link" v-if="user_id"><button @click="handleLogout" type="submit">Logout</button></form>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <router-view>
                    
                    <!-- App.vue component runs here -->
                </router-view>
            </main>
        </div>
    </template>

<!-- App.vue is imported into app.blade.php -->

<script>
    export default {
        data(){
            return {
                user_id : null,
                name : null,
                user_data: null,
                store_state: this.$ud_store.state,
            }
        },
        mounted: function(){
            // working -> -> -> -> ->
            // console.log("window.checkAuth => ", window.checkAuth)
            if (window.checkAuth === undefined) {
                this.$ud_store.commit('SET_USER_DATA', "guest" );
                this.$ud_store.commit('SET_USER_LOGGED_IN', false );
            } else {
                this.$ud_store.commit('SET_USER_DATA', window.checkAuth );
                this.$ud_store.commit('SET_USER_LOGGED_IN', true );
            }
            const p = ["background: rgb(11, 11, 13)", "color: #EF7D77", "border: 1px solid #EF7D77", "margin: 0", "padding: 0 8px 0 4px", "line-height: 32px"].join(";");
            console.log("%c LoggedIn? " + this.$ud_store.state.data.loggedIn + "", p)
            console.log("%c User: " + this.$ud_store.state.data.user_data.name + "", p)
            // this.$ud_store.commit('SET_USER_LOGGED_IN', true);
            if (this.$ud_store.state.data.user_data === "guest") {
                this.user_id = null;
                console.log('set as GUEST');
            } else {
                console.log('this.$ud_store.state.data.user_data.name => ', this.$ud_store.state.data.user_data.name )
                this.user_id = this.$ud_store.state.data.user_data.id;
                this.name = this.$ud_store.state.data.user_data.name;
                console.log('set as USER');
            }
        },
        methods: {
            // user logout function 
            handleLogout(e) {
                e.preventDefault()
                axios({
                    method: 'POST',
                    url: '/logout'
                })
                .then(response => {
                    if (response.status === 200) {
                        this.$ud_store.commit('SET_USER_DATA', "guest" );
                        this.$ud_store.commit('SET_USER_LOGGED_IN', false );
                        window.location = '/';
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            },
        }
    }
</script>
