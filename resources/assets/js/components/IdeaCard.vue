<template>
<!-- &#183 -->
    <div class="idea-card-container" >
        <router-link :to="`/idea/${this.props.id}`">
            <div class="card card-default" v-on:mouseover="play" v-on:mouseleave="stop">
                <h2 class="bold">
                    <span :class="this.props.status">
                        <lottie :options="defaultOptions" :height="20" :width="20" v-on:animCreated="handleAnimation"/>
                    </span>{{this.props.title}}
                </h2>
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
    background-color: white;
    margin: 28px 0;
    transition: .5s;
    &:hover {
        background-color: $grey;
    }
    a {
        text-decoration: none;
        .card {
            margin: 0 0 16px 0;
            padding: 28px;
            h2 {
                position: relative;
                font-size: $size-h2;
                color: $text-title-color;
                margin: 0 0 4px 0;
                span {
                    width: 20px;
                    height: 20px;
                    font-size: 32px;
                    line-height: 1rem;
                    position: absolute;
                    left: -16px;
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
                line-height: 1.5rem;
            }
        }
    }
}
</style>

<script>
    import Lottie from 'vue-lottie';
    import * as animationData from '../data/lottie/check.json';
    export default {
        name: 'IdeaCard',
        components: {
            'lottie': Lottie
        },
        props: ['props'],
        data() {
            return {
                defaultOptions: {
                    animationData: animationData,
                    autoplay: false,
                    renderer: 'svg',
                    loop: false,
                },
                animationSpeed: 2
            }
        },
        // figure out passing MySQL data to Vue
        mounted() {
            console.log('idea-card.vue mounted (this) => ', this);
            console.log('idea-card.vue mounted (this.props) => ', this.props);
        },
        methods: {
            handleAnimation: function (anim) {
                this.anim = anim;
            },
        
            stop: function () {
                this.anim.stop();
            },
        
            play: function () {
                this.anim.play();
            },
        
            // pause: function () {
            //     this.anim.pause();
            // }
        }

    }
</script>