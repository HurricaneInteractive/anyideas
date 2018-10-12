<template>
    <div class="container">
        <div class="header-container">
            <div class="card card-default"  v-bind:style="{ width: '750px', margin: '0 auto' }">
                <div class="home-header" v-on:click="animate_me()">
                    Tim's beautiful svg shower art
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card card-default"  v-bind:style="{ width: '750px', margin: '0 auto' }">
                    <div>
                        <button @click="searchDatabase">Run search query</button>
                        <div>
                            <div v-for="(value, key) in this.user_ideas" :key="key">
                                <IdeaCard key={{key}} :props='value'>
                                    <!-- <h4>{{value.title}}</h4>
                                    <p>{{value.pitch}}</p>
                                    <router-link :to="`/idea/${value.id}`">go to idea {{value.id}}</router-link> -->
                                </IdeaCard>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

.header-container {
    background-color: #F5F5F5;
    width: 100%;
    min-height: 400px;
    margin: 0;
    padding: 0;
    transition: .5s;
    text-align: center;
    display: grid;
    align-content: center;
    justify-content: center;
}
.test {
    background-color: goldenrod;
}
</style>

<script>
    import Lottie from 'vue-lottie';
    import IdeaCard from '../components/IdeaCard'
    export default {
        components: {
            IdeaCard
        },
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
        mounted() {
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