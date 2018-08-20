<template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">Treclon</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

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
            // console.log(this.userData); get all user data (name, email, username etc.)
            this.isLoggedIn = null;
            this.name = null;
            // check if user_data exists (user is logged in)
            this.checkForUserData();
            
                // console.dir('run checkForUserData');
                // console.dir(window);
                // || window.user_data.id === undefined || window.user_data.name === undefined
                // if (typeof window.user_data === undefined) {
                //     console.log('user_data is present')
                //     this.isLoggedIn = window.user_data.id,
                //     this.name = window.user_data.name
                // }
                // console.log('no user data?');
            
        },
        methods: {
            checkForUserData() {
                if (window.user_data === null) {
                    console.log('no user_data here');
                    this.isLoggedIn = null,
                    this.name = null
                } else {
                    console.log('all you can eat of user_data');
                    this.isLoggedIn = window.user_data.id,
                    this.name = window.user_data.name
                }
                console.log('no user data?');
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
                    console.error(error);
                });
            },

        }
    }
</script>
