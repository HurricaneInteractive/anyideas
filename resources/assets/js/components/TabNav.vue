<template>
<!-- &#183 -->
    <nav class="tab-nav-container fixed_width" >
      <div class="tab-nav-wrapper" v-bind:style="{ gridTemplateColumns: 'repeat(' + propsLength + ', 1fr)'}"> 
        <div :class="'tab-nav-item ' + props[key].active" v-for="(value, key) in props" :key="props[key].id">
          <!-- <router-link :to="props[key].route"> -->
          <router-link :to="{ name: props[key].id}">
            {{props[key].label}}
          </router-link>
        </div>
      </div>
    </nav>
</template>

<style lang="scss">
@import '~@/App.scss';

.tab-nav-container {
  /* width: 100%; */
  min-height: 75px;
  margin: 0 auto;
  .tab-nav-wrapper {
    width: 100%;
    display: grid;
    align-items: center;
    .true {
      border-bottom: 2px solid black;
      a {
        font-weight: $w-bold;
      }
    }
    .tab-nav-item {
      text-align: center;
      padding: 24px 0;
      a {
        text-decoration: none;
        color: $black-light;
      }
    }
  }
}
</style>

<script>
    export default {
        name: 'TabNav',
        props: [ 'props' ],
        data() {
            return {
              navData: null,
              propsLength: this.props.length
            }
        },
        watch: {
          $route: ["setData"]
        },
        beforeMount: function() {
          this.setData();
          console.log('TCL: this.props', this.props);
        },
        methods: {
          setData() {
            console.log('[TabNav] setData => ', this.props)
            this.navData = this.props;
          }
        }
    }
</script>