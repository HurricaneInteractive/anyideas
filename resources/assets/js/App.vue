<!-- App.vue acts as a wrapper for the whole application -->
<!-- use this.$ud_store in child components -->
<template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-wrapper navbar-left">
                            <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_small" class="navbar-brand"></router-link>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-wrapper navbar-right">
                            <!-- Authentication Links -->
                            <!-- <router-link :to="{ name: 'login' }" class="nav-link" v-if="!user_id">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!user_id">Register</router-link>
                            <li class="nav-link" v-if="user_id"> Hi, <router-link :to="'user/' + user_id" class="nav-link">{{name}}</router-link></li>
                            <form method="POST" action="/logout" class="nav-link" v-if="user_id"><button @click="handleLogout" type="submit">Logout</button></form> -->
                            
                            <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.search"></router-link>
                            <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.user"></router-link>
                            <router-link :to="{ name: 'add-new-idea' }" class="nav-link" v-if="user_id"><div v-html="this.$ud_store.state.icons.plus">+ New Idea</div></router-link>
                        </ul>
                    </div>
                </div>
            </nav>
            <main>
                <router-view>
                    <!-- App.vue component runs here -->
                </router-view>
            </main>
            <footer>
                <div>
                    <ul>
                        <li><router-link :to="{ name: 'index' }">News Feed</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Discover</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Success Stories</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Account</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Settings</router-link></li>
                    </ul>
                    <ul>
                        <li><router-link :to="{ name: 'login' }">Log In</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Sign Up</router-link></li>
                        <li>
                            <a href="https://facebook.com">FB icon</a>
                            <a href="https://facebook.com">Twitter icon</a>
                            <a href="https://facebook.com">Instagram icon</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li><router-link :to="{ name: 'login' }">About</router-link></li>
                        <li><router-link :to="{ name: 'login' }">Legalities</router-link></li>
                    </ul>
                    
                    <ul>
                        <li><a href="#">Built by <span>Sunset Studios</span></a></li>
                    </ul>
                </div>
                <div>
                    <img src="#" alt="footer logo"/>
                </div>
            </footer>
        </div>
    </template>

<!-- App.vue is imported into app.blade.php -->

<style lang="scss">
    @import '~@/App.scss';

    .bold {
        font-weight: $w-bold;
    }
    * {
        font-family: $font-family-sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        color: $text-title-color;
    }
    h6 {
        font-size: $size-h6;
    }
    p {
        font-weight: $w-regular;
        color: $p-color;
    }

    .navbar-wrapper {
        a {
            svg {
                width: 25px;
            }
        }
    }
</style>

<script>
    import icons from './data/icons'
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
            console.log('icons => ', this.$ud_store.state.icons.logo_small);
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
            } else {
                this.user_id = this.$ud_store.state.data.user_data.id;
                this.name = this.$ud_store.state.data.user_data.name;
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
                        window.location = 'index';
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            },
        }
    }
</script>
