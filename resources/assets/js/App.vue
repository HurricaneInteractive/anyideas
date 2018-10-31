<!-- App.vue acts as a wrapper for the whole application -->
<!-- use this.$ud_store in child components -->
<template>
    <div>
        <nav class="navbar fixed_width">
            <div class="container">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-wrapper navbar-left">
                    <li><router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_small" class="logo-icon"/>
                    </li>
                    <!-- display full logo on larger screens -->
                    <!-- <li v-else><router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.user" class="logo-icon"/>
                    </li> -->
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-wrapper navbar-right">
                    <li class="search">
                        <li class="search_text_container">
                            <div :class="'search_expand ' + this.openSearchState">
                                <span @click="handleSearch" v-html="this.$ud_store.state.icons.search" class="navbar-icon"/>
                                <input @keyup.enter="handleSearch" placeholder="search" value="search" id="search_text" type="text" class="form-control" v-model="search_text" />
                            </div>
                        </li>
                        <li v-if="this.openSearchState === false" class="navbar-icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.search">
                        </li>
                        <li v-else class="navbar-icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.marks_the_spot">
                        </li>
                    </li>
                    <li>
                        <span :class="'navbar-icon ' + this.$ud_store.state.data.loggedIn" v-on:click="openUser()" v-html="this.$ud_store.state.icons.user">
                        </span>
                        <div v-if="$ud_store.state.data.loggedIn === false" :class="'user ' + this.openUserState">
                            <!-- <span :class="'arrow ' + this.openUserState" v-html="this.$ud_store.state.icons.curve_square">
                            </span> -->
                            <div class="user_items" v-on:click="openUser()">
                                <router-link :to="{name: 'login' }">Log In</router-link>
                                <router-link :to="{name: 'register' }">Sign Up</router-link>
                            </div>
                        </div>
                        <div v-else :class="'user ' + this.openUserState">
                            <!-- <span :class="'arrow ' + this.openUserState" v-html="this.$ud_store.state.icons.curve_square">
                            </span> -->
                            <div class="user_items" v-on:click="openUser()">
                                <router-link :to="`/user/${$ud_store.state.data.user_data.id}`">View Account</router-link>
                                <p @click="handleSignOut">Sign Out</p>
                            </div>
                        </div>
                    </li>
                    <li v-if="this.$route.name === 'add-new-idea'">
                        <div v-on:click="openUser()" class="post-idea">
                            <p> POST IDEA</p>
                        </div>
                    </li>
                    <li v-else>
                        <router-link :to="{ name: 'register' }" class="add-idea">
                            <span v-html="this.$ud_store.state.icons.plus"></span>
                            <p> Sign Up</p>
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <CategoriesSlider v-if="this.$route.name === 'index' || this.$route.name === 'category'"/>
        <main>
            <router-view>
                <!-- Child components run here -->
            </router-view>
        </main>
        <footer class="footer-container">
            <div class="fixed_width">
                <div class="footer footer-left">
                    <ul>
                        <li><router-link :to="{ name: 'index' }">News Feed</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Discover</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Success Stories</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Account</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Settings</router-link></li>
                    </ul>
                    <ul>
                        <li><router-link :to="{ name: 'login' }">About</router-link></li>
                        <li><router-link :to="{ name: 'login' }">Legalities</router-link></li>
                    </ul>
                    
                    <ul>
                        <li><a href="https://sunset-studios.netlify.com" target="_blank" rel="noopener noreferrer">Built by <span>Sunset Studios</span></a></li>
                    </ul>
                </div>
                <div class="footer footer-right">
                    <ul>
                        <li><router-link :to="{ name: 'login' }">Log In</router-link></li>
                        <li><router-link :to="{ name: 'register' }">Sign Up</router-link></li>
                        
                    </ul>
                    <ul>
                        <li><a href="https://facebook.com">FB icon</a></li>
                        <li><a href="https://facebook.com">Twitter icon</a></li>
                        <li><a href="https://facebook.com">Instagram icon</a></li>
                    </ul>
                </div>
                <div class="footer-logo">
                    <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_big"></router-link>
                </div>
            </div>
        </footer>
    </div>
</template>

<!-- App.vue is imported into app.blade.php -->

<style lang="scss">
    @import '~@/App.scss';

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
        .navbar-icon {
            fill: none;
            color: $black;
            stroke: $black;
        }
        .container {
            display: flex;
            padding: 35px 0;
            min-height: 64px;
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
                .search_text_container {
                    opacity: 0;
                    display: inline-flex;
                    align-content: center;
                    justify-content: center;
                    border-bottom: 2px black solid;
                    margin: 0;
                    padding: 0 8px;
                    .search_expand {
                        width: 80%;
                        white-space: nowrap;
                        display: flex;
                        align-content: center;
                        align-items: center;
                        justify-content: center;
                        input {
                            margin: 0 24px;
                            padding: 0;
                            height: 100%;
                            width: 100%;
                            border: none;
                        }
                    }
                }
                .search {
                    position: relative;
                    .search_icon {
                        display: grid;
                        justify-content: center;
                        align-content: center;
                        svg {
                            display: grid;
                            justify-content: center;
                            align-content: center;
                        }
                    }
                }
                > li {
                    display: grid;
                    justify-content: center;
                    align-content: center;
                    position: relative;
                    z-index: 10;
                    a {
                        align-self: center;
                        justify-self: center;
                    }
                    .post-idea {
                        background-color: $primary;
                        color: $pure;
                        border: none;
                        p {
                            margin: 8px;
                            color: $pure;
                        }
                    }
                    .add-idea {
                        border: 1px solid $black;
                    }
                    .add-idea, .post-idea {
                        display: inline-flex;
                        align-content: center;
                        justify-content: center;
                        border-radius: 25px;
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
                        justify-content: flex-start;
                        fill: none;
                    }
                    .user_icon.false {
                        opacity: .5;
                    }
                    .user.false {
                        display: none;
                    }
                    .user {
                        position: absolute;
                        // top: 15px;
                        top: 100%;
                        // width: 128px;
                        // height: 128px;
                        z-index: -100;
                        left: calc(50% - 100px);
                        opacity: 0;
                        // transform: translateX(-50%);
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
                                    fill: $white;
                                    stroke: $white;
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
                            // height: 100%;
                            min-width: 200px;
                            width: 100%;
                            position: relative;
                            background-color: $white;
                            opacity: 1;
                            // display: grid;
                            // align-content: center;
                            // justify-content: center;
                            border-radius: 10px;
                            box-shadow: 0px 0px 15px 0px rgba(137, 137, 137, 0.25);
                            padding: 30px;
                            a {
                                display: block;
                                text-align: center;
                                margin: 0;
                                &:not(:first-child) {
                                    padding-top: 15px;
                                    margin-top: 15px;
                                    border-top: 1px solid rgba($black, 0.05);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    .footer-container {
        margin: 0 auto;
        padding: 0 32px;
        background-color: $white;
        > div {
            margin: 0 auto;
            padding: 68px 32px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            .footer {
                ul {
                    list-style-type: none;
                    padding: 0;
                    margin: 0 0 32px 0;
                    li {
                        margin: 4px 0;
                        a {
                            color: $p-color;
                            font-size: $size-h6;
                            text-decoration: none;
                        }
                    }
                }
            }
            .footer-right {
                ul {
                    li {
                        text-align: right;
                        a {
                            text-align: right;
                        }
                    }
                }
            }
            .footer-logo {
                grid-area: 2 / 1 / 2 / 3;
                margin: 24px auto 84px auto;
                a {
                    display: block;
                    width: 128px;
                    margin: 0 auto;
                    svg {
                        width: 100%;
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
                search_text: '',
                store_state: this.$ud_store.state,
                search_results: {}
            }
        },
        beforeMount: function() {
            const p = ["background: rgb(11, 11, 13)", "color: #EF7D77", "border: 1px solid #EF7D77", "margin: 0", "padding: 0 8px 0 4px", "line-height: 32px"].join(";");
            console.log("%c LoggedIn? " + this.$ud_store.state.data.loggedIn + "", p)
            console.log("%c User: " + this.$ud_store.state.data.user_data.name + "", p)
        },
        mounted: function(){
            console.log('window.offsetWidth => ', window)
            if (window.checkAuth === undefined) {
                this.$ud_store.commit('SET_USER_DATA', "guest" );
                this.$ud_store.commit('SET_USER_LOGGED_IN', false );
            } else {
                this.$ud_store.commit('SET_USER_DATA', window.checkAuth );
                this.$ud_store.commit('SET_USER_LOGGED_IN', true );
            }
            // this.$ud_store.commit('SET_USER_LOGGED_IN', true);
            if (this.$ud_store.state.data.user_data === "guest") {
                this.user_id = null;
            } else {
                this.user_id = this.$ud_store.state.data.user_data.id;
                this.name = this.$ud_store.state.data.user_data.name;
            }
        },
        methods: {
            handleSignOut() {
                axios({
                    method: 'POST',
                    url: '/logout',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                })
                .then(res => {
                    console.log('úser_logged out', res)

                    // window.location('/')
                    if (res.status === 200) {
                        this.$ud_store.commit('SET_USER_DATA', 'guest');
                        this.$ud_store.commit('SET_USER_LOGGED_IN', false);
                        this.$router.push({name: 'home'})
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            },
            handleSearch(e) {
                e.preventDefault();
                console.log('handleSearch(search_text)')
                if (this.search_text !== '' || this.search_text !== null) {
                    console.log('search_text === defined')
                    axios({
                        method: 'POST',
                        url: '/ai/search',
                        data: {
                            search: this.search_text
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        }
                    })
                    .then(res => {
                        this.$ud_store.commit('SET_CURRENT_SEARCH', res.data);

                        if (res.status === 200) {
                            this.$router.push({name: 'search'})
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
                } else {
                    console.log('maaaaate');
                    return alert('make sure you fill in all the fields');
                }
            },
            toggleSearchState(toggle) {
                this.openSearchState = toggle
            },
            openSearch() {
                console.log('openSearch(this.openSearchState)  => ', this.openSearchState);
                // console.log('openSearch(toggle)  => ', toggle);
                if (this.openSearchState === true) {
                    this.$animie_js({
                        targets: '.search_text_container',
                        opacity: 0,
                        translateX: {
                            value: 0,
                            duration: 1200
                        },
                        delay: 100 // All properties except 'scale' inherit 250ms delay
                    });
                } else {
                    this.$animie_js({
                        targets: '.search_text_container',
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
