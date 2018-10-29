<template>
  <section class="about fixed_width">
    <div class="idea_wrapper">
      <div class="user_stats">
        <div>
          <h2>3</h2>
          <h3>ideas</h3>
        </div>
        <div> • </div>
        <div>
          <h2>126</h2>
          <h3>followers</h3>
        </div>
      </div>

      <div class="interests">
        <h3>Interests</h3>
        <div>
          <ul v-for="(value, key) in JSON.parse(this.$ud_store.state.current_user_view.user.interests)" :key="key">
            <li key={{key}}>
              {{value}}
            </li>
          </ul>
          <!-- <button>Entertainment</button>
          <button>Arts</button>
          <button>Life</button> -->
        </div>
      </div>

      <div v-if="userOwns" class="editSection" id="editSection"/>
      <div v-else id="viewerSection"/>
    </div>
    
  </section>
</template>

<style lang="scss">
@import '~@/App.scss';

.user_stats {
  width: 250px;
  margin: 60px auto 24px;
  display: grid;
  grid-template-columns: 1fr .2fr 1fr;
  align-items: center;
  justify-content: center;
  > * {
    text-align: center;
    margin: 0 auto;
  }
  h3 {
    font-weight: $w-regular;
  }
}
.interests {
  margin: 0 auto 68px;
  h3 {
    text-align: center;
  }
  > div {
    margin: 0 auto;
    display: flex;
    align-content: center;
    justify-content: center;
    button {
      margin: 0 4px;
    }
  }
}
/* .about {
  .about-wrapper {
    max-width: 760px;
    margin: 0 auto; 
  }
} */

</style>


<script>
    require('codemirror/lib/codemirror.css') // codemirror
    require('tui-editor/dist/tui-editor.css'); // editor ui
    require('tui-editor/dist/tui-editor-contents.css'); // editor content
    require('highlight.js/styles/github.css'); // code block highlight

    var Editor = require('tui-editor');
    export default {
      name: 'About',
      props: ['data'],
      data() {
        return {
          userOwns: false,
          loaded: false
        }
      },
      beforeMount() {
        if (this.$ud_store.state.current_user_view.user.id === this.$ud_store.state.data.user_data.id) {
          console.log('user owns this page')
          this.userOwns = true;
        }
      },
      mounted() {
        console.log("%c About.vue", this.$ud_store.state.consoleLog.component)
        // console.log('interests => ', JSON.parse(this.$ud_store.state.current_user_view.user.interests))
        this.setAbout();
      },
      methods: {
        // getUserData() {

        // },
        setAbout() {
          console.warn('userOwns', this.userOwns)
          console.log('run =>', this.$ud_store.state.current_user_view.user.id )
          console.log('run =>', this.$ud_store.state.data.user_data.id )
          console.log('run =>', this.$ud_store.state.current_user_view.user_meta.bio )
          
          var viewer = Editor.factory({
            el: document.querySelector('#viewerSection'),
            viewer: true,
            height: '500px',
            initialValue: '# this.$ud_store.state.current_user_view.user_meta.bio'
          });
          var editor = new Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'markdown',
            previewStyle: 'vertical',
            height: '600px',
            // initialValue: this.$ud_store.state.current_user_view.user_meta.bio
            initialValue: '# this.$ud_store.state.current_user_view.user_meta.bio'
          });
          this.loaded = true;
        }
      }
    }
</script>