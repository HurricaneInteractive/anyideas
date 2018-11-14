<template>
    <div class="page-wrapper">
        <template v-if="loading">
            <GlobalLoading />
        </template>
        <template v-else>
            Display Stuffs
        </template>
    </div>
</template>

<style lang="scss" scoped>

</style>

<script>
    export default {
        data() {
            return {
                loading: true
            }
        },
        mounted() {
            this.fetchIndexData();
        },
        methods: {
            fetchIndexData() {
                axios.get('/api/v1/feed.get')
                    .then(res => {
                        console.log(res)
                    })
                    .catch(e => console.error(e))
            }
        }
    }
</script>
