<template>
  <section class="categories">
    <div class="categories_wrapper">
      <VuePerfectScrollbar class="scroll-area" v-once :settings="settings" @ps-scroll-y="scrollHanle">
        <ul>
          <li v-for="(value, key) in this.$ud_store.state.categories" :key="key">
            <router-link :to="`/category/${value.toLowerCase()}`" key={{key}}>{{value}}</router-link>
          </li>
        </ul>
      </VuePerfectScrollbar>
    </div>
  </section>
</template>

<style lang="scss">
  @import '~@/App.scss';
    .categories {
        width: 100%;
        /* overflow-x: scroll; */
        .categories_wrapper {
            margin: 0 16px 16px 16px;
            ul {
                display: flex;
                list-style-type: none;
                padding: 0;
                margin: 16px;
                li {
                    margin: 0 16px;
                    white-space: nowrap;
                    display: flex;
                    a {
                        text-decoration: none;
                        color: $p-color;
                    }
                }
            }
        }
    }

</style>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
    export default {
        name: 'CategoriesSlider',
        components: {
          VuePerfectScrollbar
        },
        data() {
          return {
            settings: {
              maxScrollbarLength: 60
            }
          }
        },
        mounted() {
            console.log('category.vue mounted (this) => ', this);
            console.log('.vue mounted (this.props) => ', this.props);
        },
        methods: {
          scrollHanle(evt) {
            console.log(evt)
          }
        }
    }
</script>