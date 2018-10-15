<template>
  <section class="categories">
    <div class="categories_wrapper">
      <ul>
        <li v-for="(value, key) in this.$ud_store.state.categories" :key="key">
          <router-link :to="`/category/${value.toLowerCase()}`" key={{key}}>{{value}}</router-link>
        </li>
      </ul>
    </div>
  </section>
</template>

<style lang="scss">
@import '~@/App.scss';

</style>

<script>
    export default {
        name: 'CategoriesSlider',
        mounted() {
            console.log('category.vue mounted (this) => ', this);
            console.log('.vue mounted (this.props) => ', this.props);
        },
    }
</script>