<template>
    <div class="card-container" :id="this.props.toLowerCase()">
        <router-link :to="`/category/${this.props.toLowerCase()}`">
            <h2 class="title">
                {{this.props}}
                <!-- {{this.setBackground(this.props)}} -->
            </h2>
        </router-link>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

.card-container {
    height: 198px;
    transition: .5s;
    &:hover {
        transition: .5s;
        animation: lv 100s linear infinite;
        box-shadow:inset 0px 0px 0px 10px #222;
        @keyframes lv {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 4000px 0;
            }
        }
    }
    a {
        height: 100%;
        display: grid;
        align-content: center;
        justify-content: center;
        .title {
            color: $p-color;
            text-align: center;
            text-transform: capitalize;
        }
    }
}

</style>

<script>
import * as hero from 'hero-patterns'
    export default {
        name: 'CategoryCard',
        props: ['props'],
        data() {
            return {
                categoryData: null,
                categoryBackground: null
            }
        },
        mounted() {
            // console.log('CategoryCard.vue mounted (this) => ', this);
            // console.log('CategoryCard.vue mounted (this.props) => ', this.props);
            this.setBackground();
        },
        methods: {
            setBackground() {
                this.categoryData = '#' + this.props.toLowerCase();
                this.categoryBackground = this.$ud_store.state.svgBackground[this.props.toLowerCase()];
                document.querySelector(this.categoryData).style.backgroundImage = hero[this.categoryBackground]('#dddddd');
            }
        }
    }
</script>