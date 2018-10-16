<template>
    <div class="card-container" :props="this.props" :id="this.$route.params.id">
        <div>
            <h2 class="title">
                {{this.$route.params.id}}
                <!-- {{this.setBackground(this.props)}} -->
            </h2>
        </div>
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
    div {
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
                categoryBackground: null,
                currentRoute: this.$route.params.id
            }
        },
        mounted() {
            console.log('CategoryTitleCard.vue mounted (this.$route.params.id) => ', this.$route.params.id);
            this.setBackground();
        },
        watch: {
            '$route': ['setBackground', 'setRoute']
        },
        methods: {
            setRoute() {
                this.currentRoute = this.$route.params.id
            },
            setBackground() {
                this.categoryData = '#' + this.currentRoute;
                this.categoryBackground = this.currentRoute.svgBackground[this.currentRoute];
                document.querySelector(this.categoryData).style.backgroundImage = hero[this.categoryBackground]('#dddddd');
            }
        }
    }
</script>