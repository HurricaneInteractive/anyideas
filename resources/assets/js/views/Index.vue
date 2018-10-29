<template>
    <div class="container">
        <div class="header-container">
            <div class="card card-default">
                <div class="home-header">
                    <!-- https://codepen.io/jerrylow/pen/KaPvNa -->
                    Turn Your Shower Thoughts Into <br>Power Thoughts
                    
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- <button @click="searchDatabase">Run search query</button> -->
            <div class="idea_wrapper">
                <div class="fixed_width" v-for="(value, key) in this.user_ideas" :key="key">
                    <IdeaCard key={{key}} :props='value'/>
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
.idea_wrapper {
    margin-top: 48px;
    div {
        max-width: 750px;
        margin: 0 auto;
    }
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