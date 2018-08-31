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
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                            <router-link :to="{ name: 'add-new-idea' }" class="nav-link" v-if="isLoggedIn">Add New Idea</router-link>
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
