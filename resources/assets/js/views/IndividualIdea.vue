<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <h1>{{idea_data.title}}</h1>
                        <h4>Category: {{idea_data.category}}</h4>
                        <div>Tags: {{idea_data.tags}}</div>
                        <button>{{idea_data.status}}</button>
                        <hr/>
                        <p>Pitch: {{idea_data.pitch}}</p>
                        <hr/>
                        <div>{{idea_data.description}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import marked from 'marked'
    var debounce = require('lodash.debounce');
    export default {
        data() {
            return {
                idea_data: '',
                idea_id: '5678',
                errors: [],
                ideas: []
            }
        },
        mounted() {
            console.log('home.vue page');
            axios.get('/api/idea/' + this.$route.params.id + '/get')
                .then(response => {
                    console.log('got ideas', response.data);
                    this.idea_data = response.data;
            });
        },
        methods: {
            // initIdea() {
            //     $("add_task_model").modal("show");
            // },

            // readIdeas() {
            // axios.get('/api/idea/5678/get')
            //     .then(response => {
            //       console.log('got ideas')
            //       this.ideas = response.data.ideas;
            //     });
            // }
        }

    }
</script>