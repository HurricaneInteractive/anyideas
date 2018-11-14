<template>
    <fragment>
        <GlobalNavbar v-if="!isLoginOrRegister" />
        <main>
            <router-view>
                <!-- Child components run here -->
            </router-view>
        </main>
        <GlobalFooter v-if="!isLoginOrRegister" />
    </fragment>
</template>

<style lang="scss">
    // Application Globals
    @import '~@/App.scss';
</style>

<script>
    export default {
        data(){ return{} },
        beforeMount() {},
        mounted() {},
        methods: {
/*            handleSignOut(e) {
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
*/
        },
        computed: {
            isLoginOrRegister() {
                return this.$route.matched.some(route => {
                    return route.name === 'login' || route.name === 'register'
                })
            }
        }
    }
</script>
