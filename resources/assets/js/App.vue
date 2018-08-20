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
                            <!-- <button v-on:click="handleLogout" class="nav-link" v-if="isLoggedIn">Logout</button> -->
                            <!-- <router-link :to="{ name: 'logout' }" class="nav-link" v-if="isLoggedIn">Logout</router-link> -->
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
            console.log("this.userData");
            console.log(this.userData);
            if (window.user_date !== undefined) {
                console.log('user_data undefined')

            }
            this.isLoggedIn = window.user_data.id,
            this.name = window.user_data.name
        },
        methods: {
            // user logout function
            handleLogout(e) {
                e.preventDefault()
                console.log("clicked logout");
                axios({
                    method: 'POST',
                    url: '/logout'
                })
                .then(response => {
                    console.log(response)
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
