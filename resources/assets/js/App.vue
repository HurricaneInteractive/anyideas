<!-- App.vue acts as a wrapper for the whole application -->
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
                            <router-link :to="{ name: 'login-guest' }" class="nav-link" v-if="!user_id">Login</router-link>
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
                user_id : this.$ud_store.state.user_data.id,
                name : this.$ud_store.state.user_data.name,
                store_state: this.$ud_store.state,
            }
        },
        mounted: function(){
            // working -> -> -> -> ->
            // console.log('user_id => ', this.user_id)
            // console.warn("CHILD this.store_state => ",this.store_state)
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
                        $ud_store.commit('SET_USER_DATA',
                            user_data = {
                                name: "guest"
                            }
                        );
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
