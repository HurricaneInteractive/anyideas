<template>
    <div class="container">
        <div class="row">
            <div class="header">
              <h1>Categories</h1>
            </div>
            <div v-for="(value, key) in this.$ud_store.state.categories" :key="key">
              <!-- <h2>{{value}}</h2> -->
              <CategoryCard :props="value"/>
            </div>

        </div>
    </div>
</template>

<script>
import CategoryCard from '../components/CategoryCard'
  export default {
    components: {
      CategoryCard
    },
    data() {
      return {
        category: '',
      }
    },
    mounted() {
      // console.log("props of category => ", this.props)
      // console.log('CategoriesPage.vue page');
      // get ideas by category route
      
    },
  }
</script>