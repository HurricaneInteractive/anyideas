<template>
    <nav class="navbar" v-bind:class="{profile: isUserProfilePage, addidea: isIdeaPage}" v-if="!isLoginOrRegister">
        <div class="container fixed_width">
            <ul class="navbar-wrapper navbar-left">
                <li>
                    <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_small" class="logo-icon" />
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-wrapper navbar-right">
                <li class="search">
                    <span @click="handleSearch" v-html="this.$ud_store.state.icons.search" class="navbar-icon" />
                    <!-- <li class="search_text_container">
                        <div :class="'search_expand ' + this.openSearchState">
                            <span @click="handleSearch" v-html="this.$ud_store.state.icons.search" class="navbar-icon" />
                            <input @keyup.enter="handleSearch" placeholder="search" value="search" id="search_text" type="text"
                                class="form-control" v-model="search_text" />
                        </div>
                    </li>
                    <template v-if="this.openSearchState === false">
                        <li class="navbar-icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.search">
                        </li>
                    </template>
                    <template v-else>
                        <li class="navbar-icon" v-on:click="openSearch()" v-html="this.$ud_store.state.icons.marks_the_spot">
                        </li>
                    </template> -->
                </li>
                <li>
                    <span :class="'navbar-icon ' + this.$ud_store.state.data.loggedIn" v-html="this.$ud_store.state.icons.user">
                    </span>
                    <ul :class="'user ' + this.openUserState">
                        <template v-if="$ud_store.state.data.loggedIn === false">
                            <li><router-link :to="{name: 'login' }">Log In</router-link></li>
                            <li><router-link :to="{name: 'register' }">Sign Up</router-link></li>
                        </template>
                        <template v-else>
                            <li><router-link :to="`/user/${$ud_store.state.data.user_data.id}`">View Account</router-link></li>
                            <li><a href="#logout" @click="handleSignOut">Sign Out</a></li>
                        </template>
                    </ul>
                </li>

                <li>
                    <template v-if="this.$ud_store.state.data.loggedIn === false">
                        <BaseButton :to="{name: 'register'}" raised text="Sign Up" />
                    </template>
                    <template v-else>
                        <BaseButton :to="{name: 'add-new-idea'}" text="Idea" raised />
                    </template>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style lang="scss" scoped>
    @import '~@/setup/_colors.scss';

    .navbar {
        padding: 30px 0;
        &.profile,
        &.addidea {
            background: get-color('white');
        }
        /deep/ .navbar-icon svg {
            fill: none;
            color: get-color('black');
            stroke: get-color('black');
            cursor: pointer;
        }
        > .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            .navbar-wrapper {
                margin: 0;
                padding: 0;
                list-style: none;
                > li {
                    .user_icon {
                        cursor: pointer;
                    }
                    svg {
                        width: 25px;
                    }
                }
                &.navbar-left {
                    a {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 30px;
                        height: 30px;
                        /deep/ svg {
                            display: block;
                            width: 100%;
                        }
                    }   
                }
                &.navbar-right {
                    flex-grow: 2;
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    > li {
                        margin-left: 15px;
                        position: relative;
                        .navbar-icon {
                            width: 30px;
                            height: 30px;
                            padding: 5px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            /deep/ svg {
                                display: block;
                                width: 100%;
                            }
                        }
                        &:hover {
                            > ul {
                                transform: translateX(-50%) translateY(0);
                                opacity: 1;
                                pointer-events: all;
                            }
                        }
                        > ul {
                            // display: none;
                            position: absolute;
                            top: 100%;
                            left: 50%;
                            transform: translateX(-50%) translateY(10px);
                            opacity: 0;
                            pointer-events: none;
                            z-index: 99;
                            padding: 10px 0;
                            background: get-color('pure');
                            min-width: 200px;
                            border-radius: 5px;
                            box-shadow: 0 3px 6px rgba(get-color('black'), 0.16);
                            transition: transform 250ms ease-in-out, opacity 250ms ease-in-out;
                            li {
                                width: 100%;
                                list-style: none;
                                text-align: center;
                                font-size: 1em;
                                &:not(:last-child) {
                                    a {
                                        border-bottom: 1px solid rgba(get-color('black'), 0.05);
                                    }
                                }
                                a {
                                    display: block;
                                    padding: 10px;
                                    color: get-color('black');
                                    cursor: pointer;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>

<script>
    export default {
        props: {
            searchOpen: {
                type: Boolean,
                default: false
            },
            openUserState: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            handleSearch() {

            }
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
