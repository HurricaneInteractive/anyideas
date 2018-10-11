<template>
    <div class="idea-card-container">
        <router-link :to="`/idea/${this.props.id}`">
            <div class="card card-default">
                <h2 class="bold"><span :class="this.props.status">&#183</span>{{this.props.title}}</h2>
                <div class="status_category">
                    <h6 :class="'bold status ' + this.props.status">{{this.props.status}}</h6>
                    <h6 class="bold category">{{this.props.category}}</h6>
                </div>
                <p>{{this.props.pitch}}</p>
            </div>
        </router-link>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

.idea-card-container {
    /* background-color: white; */
    margin: 28px 0;
    transition: .5s;
    a {
        text-decoration: none;
        .card {
            margin: 0 0 60px 0;
            h2 {
                position: relative;
                font-size: $size-h2;
                color: $text-title-color;
                margin: 0 0 4px 0;
                span {
                    font-size: 32px;
                    line-height: 1rem;
                    position: absolute;
                    left: -10px;
                    top: 0;
                    bottom: 0;
                }
            }
            .status_category {
                display: inline-flex;
                * {
                    margin: 0 16px 0 0;
                }
                margin: 0 0 22px 0;
            }
            p {
                margin: 4px 0 0 0;
            }
        }
    }
}
</style>

<script>
    export default {
        name: 'IdeaCard',
        props: ['props'],
        // data() {
        //     return {
        //       idea: {
        //         id: '',
        //         title: '',
        //         elevator: '',
        //         status: '',
        //         category: '',
        //       },
        //     }
        // },
        // figure out passing MySQL data to Vue
        mounted() {
          console.log('idea-card.vue mounted (this) => ', this);
          console.log('idea-card.vue mounted (this.props) => ', this.props);
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