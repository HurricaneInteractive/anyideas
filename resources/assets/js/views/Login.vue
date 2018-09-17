<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <h2>log in page</h2>
                    <h3>{{$ud_store.state.user_data.name}}</h3>

                    <div class="card-body">
                        <form method="POST" action="/login">

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Login
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email : "",
                password : ""
            }
        },
        mounted: function(){
            // working -> -> -> -> ->
            // console.log('user_id => ', $ud_store.state.user_data.user_id)
            // console.warn("CHILD this.store_state => ", $ud_store.state.user_data)
        },
        methods : {
            handleSubmit(e){
                e.preventDefault()
                console.log(this.email);
                console.log(this.password);
                if (this.password.length > 0) {
                    axios({
                        method: 'POST',
                        data: {
                            email: this.email,
                            password: this.password
                        },
                        url: '/login'
                    })
                    .then(response => {
                        console.clear;
                        console.log('TCL: handleSubmit -> response', response);
                        console.log('TCL: handleSubmit -> response.data', response.data);
                        console.log('TCL: handleSubmit -> response.data.user', response.data.user);
                        if (response.status === 200) {
                            console.log('login .then')
                            this.$ud_store.commit('SET_USER_DATA', response.data.user);
                            window.location = '/';
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
                }
            }
        }
    }
</script>