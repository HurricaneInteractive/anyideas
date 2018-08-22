<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Add Idea</div>

                    <div class="card-body">
                        <form method="POST" action="{route('add-idea') }">

                            <!-- add schmick dynamic form code here -->
                            <!-- <div v-for="(value, key, index) in formItems" class="form-group row">
                                <label for="key.id" class="col-md-4 col-form-label text-md-right">{{value.display}}</label>
                                {{ index }}
                                {{ value.display }}
                                {{ value.id }}
                                {{ value.type }}
                                <div v-if="index.required === true" class="col-md-6">
                                    <input id={index.id} type={index.type} class="form-control" required v-model="index.model" />
                                </div>

                                <div v-else class="col-md-6">
                                    <input id={index.id} type={{index.type}} class="form-control" v-model="index.model" />
                                </div>
                            </div> -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Submit idea
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
                name : "",
                username: "",
                email : "",
                password : "",
                password_confirmation: ""
            }
        },
        mounted() { 
            // this.readIdeas();
            // this.generateForm(formItems);
        },
        // computed: {
        //     formToRender: this.generateForm(formItems)
        // },
        methods: {
            handleSubmit(e) {
                console.log('​handleSubmit -> ', );
                e.preventDefault()
            },
        }
    }
</script>

