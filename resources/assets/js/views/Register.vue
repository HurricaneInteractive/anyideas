<template>
    <div class="register-view">
        <div class="container">
            <header>
                <router-link :to="{name: 'index'}" v-html="this.$ud_store.state.icons.logo_big"></router-link>
            </header>
            <div class="steps-container">
                <RegisterName />
                <a href="#" class="btn btn-register">Next <span v-html="this.$ud_store.state.icons.arrow_right" /></a>
                <ul class="dots">
                    <li class="active"><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    @import '~@/_variables.scss';
    .register-view {
        background: $white;
        min-height: 100vh;
        padding: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        .container {
            max-width: 360px;
            margin: 0 auto;
            > header {
                max-width: 170px;
                margin: 0 auto 50px;
                a, svg {
                    display: block;
                }
            }
            .steps-container {
                padding: 50px 40px 85px;
                background: white;
                position: relative;
                .btn {
                    text-align: center;
                    background: rgba($primary, 0.2);
                    font-size: 1.2em;
                    font-weight: $w-bold;
                    color: $primary;
                    display: block;
                    max-width: 225px;
                    width: 100%;
                    margin: 0 auto;
                    padding: 12px;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .dots {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    text-align: center;
                    position: absolute;
                    bottom: 17px;
                    left: 50%;
                    transform: translateX(-50%);
                    li {
                        display: inline-block;
                        margin: 0 5px;
                        &.active {
                            a {
                                background: $primary;
                            }
                        }
                        a {
                            display: block;
                            width: 7px;
                            height: 7px;
                            border-radius: 50%;
                            background: rgba($primary, 0.2);
                        }
                    }
                }
            }
        }
    }
</style>

<style lang="scss">
    @import '~@/_variables.scss';
    .steps-container {
        .step {
            blockquote {
                text-align: center;
                font-size: 1.4em;
                margin: 0;
                > p {
                    margin: 0;
                }
                cite {
                    margin: 24px 0 0;
                    font-style: normal;
                    text-transform: uppercase;
                    font-size: 0.6em;
                    display: block;
                }
            }
            .form-block {
                margin: 50px 0 30px;
                padding: 30px;
                background: rgba($primary, 0.05);
                .input-field {
                    position: relative;
                    &:not(:first-child) {
                        margin-top: 40px;
                    }
                    input {
                        padding: 0 10px 10px;
                        background: transparent;
                        border: none;
                        border-bottom: 1px solid $primary;
                        width: 100%;
                        font-family: $font-family-sans-serif;
                        font-size: 1em;
                        &:focus {
                            outline: none;
                        }
                        &:focus,
                        &.has-content {
                            & + label {
                                top: calc(-100% + 10px);
                                left: 0;
                                font-size: 0.8em;
                            }
                        }
                    }
                    label {
                        font-size: 1em;
                        position: absolute;
                        top: 0%;
                        left: 10px;
                        pointer-events: none;
                        color: rgba($primary, 0.7);
                        transition: all 200ms ease-in-out;
                    }
                }
            }
        }
    }
</style>


<script>
    import RegisterName from '../components/register/RegisterName'
    export default {
        components: {
            RegisterName
        },
        data(){
            return {
                name : null,
                username: null,
                email: null,
                interests: null,
                password : null,
                password_confirmation: null
            }
        },
        methods : {
            handleSubmit(e) {
                e.preventDefault()

                console.log(this.name)
                console.log(this.username)
                console.log(this.email)
                console.log(this.interests)
                console.log(this.password)

                // PATH TO REGISTER ROUTE app\Http\Controllers\Auth\RegisterController.php
                // make sure validator items are met - if not, change them
                
                // data items need to be stringify'd before pushing to the DB
                // return items need to be parsed back into arrays/objects

                if (this.password === this.password_confirmation && this.password.length > 5) {
                    axios({
                        method: 'POST',
                        data: {
                            name: this.name,
                            username: this.username,
                            email: this.email,
                            interests: this.interests,
                            password: this.password,
                            password_confirmation: this.password_confirmation
                        },
                        url: '/register'
                    })
                    .then(response => {
                        console.log("register response")
                        console.log(response)
                        if (response.status === 200) {
                            window.location = '/';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
                } else {
                    this.password = ""
                    this.password_confirmation = ""

                    return alert('Password is not long enough')
                }
            }
        }
    }
</script>