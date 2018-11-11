<template>
    <div class="container fixed_width">
        <div class="row page-wrapper">
            <div class="header">
              <h1>Categories</h1>
            </div>
            <div v-for="(value, key) in this.$ud_store.state.categories" :key="key">
              <CategoryCard :props="value"/>
            </div>

        </div>
    </div>
</template>

<style lang="scss" scoped>
  .header {
    h1 {
      margin-top: 0;
    }
  }
</style>


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
    mounted() {}
  }
</script>