<template>
    <div class="container">
        <div class="row">
            <CategoryTitleCard :props="this.currentRoute" class="category-header"/>
            <div v-for="(value, key) in this.category_data" :key="key">
                <IdeaCard key={{key}} :props='value'/>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
  .header{
    h1 {
      text-transform: capitalize;
    }
  }
</style>

<script>
import * as hero from 'hero-patterns'
import IdeaCard from '../components/IdeaCard'
import CategoryTitleCard from '../components/CategoryTitleCard'
  export default {
    components: {
      IdeaCard, CategoryTitleCard
    },
    data() {
      return {
        category_data: '',
        currentRoute: this.$route.params.id
      }
    },
    mounted() {
      console.log('this.$route.params.id => ', this.$route.params.id)
      this.handleGetIdeaByCategories(this.$route.params.id);
    },
    watch: {
      // call again the method if the route changes
      '$route': ['handleGetIdeaByCategories', 'setRoute']
    },
    methods: {
      // get ideas by Categories functions
      setRoute() {
        this.currentRoute = this.$route.params.id
      },
      handleGetIdeaByCategories() {
        console.log('this.$route handleGetIdeaByCategories() => ', this.$route)
        console.log('this.$route.params.id handleGetIdeaByCategories() => ', this.$route.params.id)
        axios({
          method: 'POST',
          url: '/ai/idea/get-by-category/' + this.$route.params.id,
        }).then( (response) => {
            this.category_data = response.data;
            console.warn('this.category_data => ', this.category_data)
        });
      }
    }
  }
</script>