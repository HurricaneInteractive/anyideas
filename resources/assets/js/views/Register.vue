<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Register</div>

            <div class="card-body">
                <form method="POST" action="/register">
                    <div class="form-group">
                        <label for="name">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" v-model="username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" v-model="email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interests" class="col-md-4 col-form-label text-md-right">Interests</label>

                        <div class="col-md-6">
                            <input id="interests" type="text" class="form-control" v-model="interests" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" v-model="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control" v-model="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
        export default {
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