<!-- App.vue acts as a wrapper for the whole application -->
<!-- use this.$ud_store in child components -->
<template>
        <div>
            <nav class="navbar">
                <div class="container">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-wrapper navbar-left">
                        <li><router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_small" class="navbar-brand"></router-link></li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-wrapper navbar-right">
                        <li class="search">
                            <span v-if="this.openSearchState === false" class="search_icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.search">
                            </span>
                            <li v-if="this.openSearchState === true">
                                <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.search" class="navbar-brand"></router-link>
                                <div :class="'search_expand ' + this.openSearchState">
                                    <p>Search</p>
                                </div>
                            </li>
                            <span v-else class="search_icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.user">
                            </span>
                            
                        </li>
                        <li>
                            <span class="user_icon" v-on:click="openUser()" v-html="this.$ud_store.state.icons.user">
                            </span>
                            <div :class="'user ' + this.openUserState">
                                <span :class="'arrow ' + this.openUserState" v-html="this.$ud_store.state.icons.curve_square">
                                </span>
                                <div class="user_items" v-on:click="openUser()">
                                    <router-link :to="{name: 'login' }">Log In</router-link>
                                    <router-link :to="{name: 'register' }">Sign Up</router-link>
                                </div>
                            </div>
                        </li>
                        <li>
                            <router-link :to="{ name: 'add-new-idea' }" class="add-idea"
                                
                            >
                                <span v-html="this.$ud_store.state.icons.plus"></span>
                                <p> Idea</p>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </nav>
            <CategoriesSlider v-if="this.$route.name === 'index' || this.$route.name === 'category'"/>
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

    // global 
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


    // App.vue specific
    .navbar-wrapper {
        > li {
            .user_icon {
                cursor: pointer;
            }
            svg {
                width: 25px;
            }
        }
    }

    .navbar {
        .container {
            display: flex;
            margin: 35px;
            .navbar-wrapper {
                list-style-type: none;
                padding: 0;
                margin: 0;
                align-content: center; 
                li {
                    margin: 0 16px;
                }
            }
            .navbar-left {
                width: 25%;
                display: inline-flex;
                justify-content: flex-start;
                > li {
                    display: inline-flex;
                    a {
                        display: grid;
                        align-content: center;
                    }
                    div {
                        padding-left: 16px;
                    }
                }
            }
            .navbar-left.true {
                border-bottom: 2px solid black;
            }
            .navbar-right {
                width: 75%;
                display: inline-flex;
                justify-content: flex-end;
                .search {
                    position: relative;
                    display: flex;
                    .search_expand {
                        width: 80%;
                        div {
                            white-space: nowrap;
                        }
                    }
                    .search_icon {
                        display: grid;
                        justify-content: center;
                        align-content: center;
                    }
                }
                > li {
                    display: flex;
                    position: relative;
                    z-index: 10;
                    a {
                        align-self: center;
                        justify-self: center;
                    }
                    .add-idea {
                        display: inline-flex;
                        align-content: center;
                        justify-content: center;
                        border-radius: 25px;
                        border: 1px solid $black;
                        padding: 0 16px;
                        text-decoration: none;
                        > span {
                            display: grid;
                            align-content: center;
                            justify-content: center;
                            svg {
                                width: 18px;
                                height: 18px;
                            }
                        }
                        p {
                            margin: 8px;
                        }
                    }
                    .user_icon {
                        display: grid;
                        align-content: center;
                        justify-content: center;
                    }
                    .user.false {
                        display: none;
                    }
                    .user {
                        position: absolute;
                        top: 15px;
                        width: 128px;
                        height: 128px;
                        z-index: -100;
                        left: -200%;
                        opacity: 0;
                        .arrow {
                            position: relative;
                            bottom: -12%;
                            height: 30px;
                            z-index: 100;
                            display: flex;
                            z-index: -100;
                            fill: $white;
                            stroke: $white;
                            svg {
                                width: 100%;
                                z-index: -100;
                                > * {
                                    height: 15px;
                                    width: 15px;
                                    fill: $grey;
                                    stroke: $grey;
                                    border: 1px solid black;
                                    border-color: transparent transparent $white $white;
                                    z-index: -100;
                                }
                            }
                        }
                        a {
                            margin: 14px auto;
                            color: $p-color;
                        }
                        .user_items {
                            z-index: 100;
                            height: 100%;
                            width: 100%;
                            position: relative;
                            background-color: $white;
                            opacity: 1;
                            display: grid;
                            align-content: center;
                            justify-content: center;
                            border-radius: 10px;
                            box-shadow: 0px 0px 15px 0px rgba(137, 137, 137, 0.25);
                        }
                    }
                }
            }
        }
    }
</style>

<script>
import CategoriesSlider from './components/CategoriesSlider'
    export default {
        components: {
            CategoriesSlider
        },
        data(){
            return {
                openUserState: false,
                openSearchState: false,
                user_id : null,
                name : null,
                user_data: null,
                store_state: this.$ud_store.state,
            }
        },
        mounted: function(){
            // console.log("this.$route.name => ", this.$route.name);
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
            } else {
                this.user_id = this.$ud_store.state.data.user_data.id;
                this.name = this.$ud_store.state.data.user_data.name;
            }
        },
        methods: {
            toggleSearchState(toggle) {
                this.openSearchState = toggle
            },
            openSearch() {
                console.log('openSearch(this.openSearchState)  => ', this.openSearchState);
                // console.log('openSearch(toggle)  => ', toggle);
                if (this.openSearchState === true) {
                    this.$animie_js({
                        targets: '.search_expand',
                        opacity: 0,
                        translateX: {
                            value: 0,
                            duration: 1200
                        },
                        delay: 100 // All properties except 'scale' inherit 250ms delay
                    });
                } else {
                    this.$animie_js({
                        targets: '.search_expand',
                        opacity: 1,
                        translateX: {
                            value: -224,
                            duration: 1200
                        },
                        delay: 100 // All properties except 'scale' inherit 250ms delay
                    });
                }
                if (this.openSearchState === false) {
                    this.toggleSearchState(true)
                } else {
                    this.toggleSearchState(false)
                }
            },
            menuState(toggle) {
                this.openUserState = toggle
            },
            openUser() {
                console.log('openUser(toggle) => ', this.openUserState);
                if (this.openUserState === true) {
                    this.$animie_js({
                        targets: '.user',
                        opacity: 0,
                        translateY: {
                            value: 0,
                            duration: 800
                        },
                        delay: 100 // All properties except 'scale' inherit 250ms delay
                    });
                } else {
                    this.$animie_js({
                        targets: '.user',
                        opacity: 1,
                        translateY: {
                            value: 10,
                            duration: 800
                        },
                        delay: 100 // All properties except 'scale' inherit 250ms delay
                    });
                }
                if (this.openUserState === false) {
                    this.menuState(true)
                } else {
                    this.menuState(false)
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
