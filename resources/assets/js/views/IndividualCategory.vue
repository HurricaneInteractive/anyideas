<template>
    <div class="container fixed_width">
        <div class="row">
            <CategoryTitleCard :props="currentRoute" class="category-header"/>
            <div class="idea_wrapper page-wrapper">
              <template v-if="category_data.length !== 0">
                <template v-for="(value, key) in category_data">
                    <IdeaCard :key="key" :props='value' />
                </template>
              </template>
              <template v-else>
                  <noideas />
              </template>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
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
        category_data: [],
        currentRoute: this.$ud_store.state.current_category_id
      }
    },
    beforeMount() {
      this.setRoute();
    },
    mounted() {
      if (this.category_data === null || this.category_data === undefined || this.category_data.length === 0) {
        this.setRoute();
      }
    },
    watch: {
      '$route': ['setRoute']
    },
    methods: {
      // get ideas by Categories functions
      setRoute() {
        this.currentRoute = this.$ud_store.state.current_category_id;
        this.handleGetIdeaByCategories();
      },
      handleGetIdeaByCategories() {
        axios({
          method: 'POST',
          url: '/ai/idea/get-by-category/' + this.$ud_store.state.current_category_id,
        }).then( res => {
          this.category_data = res.data;
        });
      }
    }
  }
</script>