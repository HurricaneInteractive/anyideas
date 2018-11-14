<template>
    <footer class="footer-container">
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
</template>

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
    export default {
        computed: {
            user_data() {
                return this.$ud_store.getters.getUserData
            }
        }
    }
</script>
