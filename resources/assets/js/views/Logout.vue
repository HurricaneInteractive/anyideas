<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Logout</div>

                    <div class="card-body">
                        <form method="POST" action="/logout">
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Logout
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
                
            }
        },
        methods : {
            handleSubmit(e){
                e.preventDefault()
                    axios({
                        method: 'POST',
                        // data: {
                        //     email: this.email,
                        //     password: this.password
                        // },
                        url: '/logout'
                    })
                    .then(response => {
                        if (response.status === 200) {
                            window.location = '/';
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        }
    }
</script>