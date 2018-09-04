<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default"  v-bind:style="{ width: '750px', margin: '0 auto' }">
                    <div class="card-header">Home.vue View</div>

                    <div class="card-body">
                        <h1>Home page boi</h1>
                    </div>

                    <div>
                        <button @click="searchDatabase">Run search query</button>
                        <h2>users ideas</h2>
                        <div>
                            <div v-for="(value, key) in this.user_ideas" :key="key">
                                <div key={{key}}>
                                    <h4>{{value.title}}</h4>
                                    <p>{{value.pitch}}</p>
                                    <router-link :to="`/idea/${value.id}`">go to idea {{value.id}}</router-link>
                                </div>
                            </div>
                        </div>
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
                user_ideas: '',
                search_results: '',
                errors: [],
                ideas: []
            }
        },
        // figure out passing MySQL data to Vue
        mounted() {
            console.log("this => " + this.data);
            axios.post('/ai/idea/get-by-user/1234')
                .then(response => {
                    this.user_ideas = response.data;
            });
        },
        methods: {
            searchDatabase() {
                axios({
                    method: 'POST',
                    url: '/ai/search',
                    data: {
                        search: "steve"
                    },
                }).then( (response) => {
                    console.log('TCL: search -> response', response);
                });
            }
        }

    }
</script>