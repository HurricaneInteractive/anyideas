<template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">Logo</router-link>
                    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                            <li class="nav-link" v-if="isLoggedIn"> Hi, {{name}}</li>
                            <form method="POST" action="/logout" class="nav-link" v-if="isLoggedIn"><button @click="handleLogout" type="submit">Logout</button></form>
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
                isLoggedIn : null,
                name : null
            }
        },
        props: [
            'userData'
        ],
        mounted(){
            this.isLoggedIn = null;
            this.name = null;
            // check if user_data exists (user is logged in)
            this.checkForUserAPIData();
            this.checkForUserData();
            
        },
        methods: {
            checkForUserAPIData() {
                axios.get('/user')
                .then(response => {
                    console.log(response.data);
                    console.log(response);
                });
            },
            checkForUserData() {
                console.log(window.user_data);
                if (window.user_data === null) {
                    this.isLoggedIn = null,
                    this.name = null,
                    console.log(window.user_data);
                } else {
                    this.isLoggedIn = window.user_data.id,
                    this.name = window.user_data.name,
                    console.log(window.user_data);
                }
            },
            // user logout function
            handleLogout(e) {
                e.preventDefault()
                axios({
                    method: 'POST',
                    url: '/logout'
                })
                .then(response => {
                    if (response.status === 200) {
                        window.location = '/';
                    }
                })
                .catch(error => {
                    console.log('​handleLogout -> error', error);
                });
            },

        }
    }
</script>
