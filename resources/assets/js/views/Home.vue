<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Home.vue View</div>

                    <div class="card-body">
                        <h1>Home page</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                idea: {
                    title: '',
                    description: ''
                },
                errors: [],
                ideas: []
            }
        },
        // components: {

        // },
        mounted() {
            // this.readIdeas();
            console.log('home.vue page');
        },
    }
</script>