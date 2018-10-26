<template>
<!-- &#183 -->
    <nav class="tab-nav-container fixed_width" >
      <div class="tab-nav-wrapper" v-bind:style="{ gridTemplateColumns: 'repeat(' + propsLength + ', 1fr)'}"> 
        <div :class="'tab-nav-item ' + props[key].active " v-for="(value, key) in props" :key="props[key].id">
          <router-link :to="props[key].route">
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
        beforeMount: function() {
          this.navData = this.props;
          console.log('TCL: this.props', this.props);
          console.log('TCL: this.props', this.props[0]);
          console.log('TCL: this.props', this.props[0].label);
          console.log('TCL: this.props', this.props[0].id);
          console.log('TCL: this.props', this.props[0].route);
          console.log('TCL: this.navData', this.navData);

        },
        mounted: function(){
          
          this.navData = this.props;
          console.log('this.props => ', this.props)
          console.log('this.navData => ', this.navData)
          console.log('this.navData => ', this.navData[0])
        }
    }
</script>