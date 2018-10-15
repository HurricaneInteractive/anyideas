<template>
    <div class="card-container" :id="this.$route.params.id">
        <h2 class="title">
            {{this.props}}
            <!-- {{this.setBackground(this.props)}} -->
        </h2>
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
        name: 'CategoryTitleCard',
        data() {
            return {
                categoryData: null,
                categoryBackground: null
            }
        },
        mounted() {
            console.log('CategoryTitleCard.vue mounted (this.$route.params.id) => ', this.$route.params.id);
            this.setBackground();
        },
        watch: {
            '$route': 'setBackground'
        },
        methods: {
            setBackground() {
                this.categoryData = '#' + this.$route.params.id;
                console.warn('this.categoryData => ', this.categoryData)
                this.categoryBackground = this.$ud_store.state.svgBackground[this.$route.params.id];
                document.querySelector(this.categoryData).style.backgroundImage = hero[this.categoryBackground]('#dddddd');
            }
        }
    }
</script>