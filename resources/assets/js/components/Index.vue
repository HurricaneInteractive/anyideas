<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Index.vue Component</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Index',
        data() {
            return {
                user: {
                    name: 'name_of_user'
                },
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
            // console.log('index.vue mounted');
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