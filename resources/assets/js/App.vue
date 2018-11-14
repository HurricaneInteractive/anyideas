<template>
    <fragment>
        <GlobalNavbar />
        <CategoriesSlider v-if="this.$route.name === 'index' || this.$route.name === 'category'"/>
        <main>
            <router-view>
                <!-- Child components run here -->
            </router-view>
        </main>
        <footer class="footer-container" v-if="!isLoginOrRegister">
            <div class="fixed_width">
                <div class="footer footer-left">
                    <ul>
                        <li><router-link :to="{ name: 'index' }">News Feed</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Discover</router-link></li>
                        <li><router-link :to="{ name: 'index' }">Success Stories</router-link></li>
                        <li><router-link v-if="this.$ud_store.state.data.loggedIn !== false" :to="`/user/${$ud_store.state.data.user_data.id}`">Account</router-link></li>
                        <li><router-link v-if="this.$ud_store.state.data.loggedIn !== false" :to="`/user/${$ud_store.state.data.user_data.id}`">Settings</router-link></li>
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
                    <ul v-if="user_data === null">
                        <li><router-link :to="{ name: 'login' }">Log In</router-link></li>
                        <li><router-link :to="{ name: 'register' }">Sign Up</router-link></li>
                    </ul>
                    <ul class="social-media">
                        <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" v-html="this.$ud_store.state.icons.social.facebook" /></li>
                        <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer" v-html="this.$ud_store.state.icons.social.instagram" /></li>
                        <li><a href="https://youtube.com" target="_blank" rel="noopener noreferrer" v-html="this.$ud_store.state.icons.social.youtube" /></li>
                    </ul>
                </div>
                <div class="footer-logo">
                    <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_big"></router-link>
                </div>
            </div>
        </footer>
    </fragment>
</template>

<!-- App.vue is imported into app.blade.php -->

<style lang="scss">
    // Application Globals
    @import '~@/App.scss';
</style>


<style lang="scss" scoped>
    @import '~@/_variables.scss';
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
                .social-media {
                    a, svg {
                        display: block;
                        width: 21px;
                        height: 21px;
                        margin-left: auto;
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
                search_text: '',
                search_results: {}
            }
        },
        beforeMount: function() {
        },
        mounted: function(){
            if (this.user_data === null) {
                this.user_id = null;
            } else {
                this.user_id = this.user_data.id;
                this.name = this.user_data.name;
            }
        },
        methods: {
            handleSignOut(e) {
                e.preventDefault();
                this.menuState(false);
                axios({
                    method: 'POST',
                    url: '/logout',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                })
                .then(res => {
                    if (res.status === 200) {
                        this.$ud_store.commit('SET_USER_DATA', 'guest');
                        this.$ud_store.commit('SET_USER_LOGGED_IN', false);
                        window.location = '/'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            },
            handleSearch(e) {
                this.toggleSearchState(false);
                e.preventDefault();

                //SET_CURRENT_SEARCH_QUERY
                this.$ud_store.commit('SET_CURRENT_SEARCH_QUERY', this.search_text);
                
                if (this.$route.name !== 'search') {
                    this.$router.push({name: 'search'})
                }
            },
            toggleSearchState(toggle) {
                this.openSearchState = toggle
            },
            openSearch() {
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
        },
        computed: {
            isUserProfilePage() {
                return this.$route.matched.some(route => {
                    return route.name === 'user' || (typeof route.parent !== 'undefined' && route.parent.name === 'user')
                })
            },
            isIdeaPage() {
                return this.$route.matched.some(route => {
                    return route.name === 'add-new-idea' || route.name === 'idea'
                })
            },
            user_data() {
                return this.$ud_store.getters.getUserData
            },
            isLoginOrRegister() {
                return this.$route.matched.some(route => {
                    return route.name === 'login' || route.name === 'register'
                })
            }
        }
    }
</script>
