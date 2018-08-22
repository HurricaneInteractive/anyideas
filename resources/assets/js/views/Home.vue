<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Home.vue View</div>

                    <div class="card-body">
                        <h1>Home page boi</h1>
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
        // figure out passing MySQL data to Vue
        mounted() {
            // this.readIdeas();
            console.log('home.vue page');
        },
        methods: {
            // initIdea() {
            //     $("add_task_model").modal("show");
            // },

            // readIdeas() {
            // axios.get('http://127.0.0.1:8000/idea')
            //     .then(response => {
            //         this.ideas = response.data.ideas;
            //     });
            // }
        }

    }
</script>