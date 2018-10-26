<template>
    <div class="container">
        <div class="row">
            <!-- <CategoryTitleCard :props="this.currentRoute" class="category-header"/> -->
            <h2>search term here</h2>>
            <!-- map over search results - show 3 users max and then the rest ideas -->
            <div v-for="(value, key) in this.category_data" :key="key">
                <IdeaCard key={{key}} :props='value'/>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

</style>

<script>
import IdeaCard from '../components/IdeaCard'
  export default {
    name: 'SearchResults',
    components: {
      IdeaCard
    },
    data() {
      return {
        currentRoute: this.$route.params.id
      }
    },
    mounted() {
      console.log('this.$route.params.id => ', this.$route.params.id)
    },
    methods: {
    }
  }
</script>