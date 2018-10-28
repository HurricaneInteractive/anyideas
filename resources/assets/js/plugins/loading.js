import Loading from '../components/global/Loading.vue';

export default {
  Loading,
  install (Vue, options) {
    Vue.prototype.$loading = Loading;
  }
}

// access using this.$loading