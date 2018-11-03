<template>
  <section class="description fixed_width">
    <div id="editSection" class="editSection"/>
  </section>
</template>

<style lang="scss">
@import '~@/_variables.scss';


</style>

<script>
    require('codemirror/lib/codemirror.css') // codemirror
    require('tui-editor/dist/tui-editor.css'); // editor ui
    require('tui-editor/dist/tui-editor-contents.css'); // editor content
    require('highlight.js/styles/github.css'); // code block highlight

    var Editor = require('tui-editor');
    export default {
      name: 'Description',
      props: ['data'],
      data() {
        return {
          loaded: false
        }
      },
      computed: {
        currentIdeaData() {
          return this.$ud_store.getters.getCurrentIdea
        },
        getIdeaUserId() {
          return this.$ud_store.getters.getCurrentIdeaUserId
        },
        currentUserData() {
          return this.$ud_store.getters.getUserData
        },
        currentIdeaDescription() {
          return this.$ud_store.getters.getCurrentIdeaDescription
        }
      },
      watch: {
        $route: function(to, from) {
          if (to.params.id !== from.params.id) {
              this.updateDescription();
              // handle get more data here;
          }
        }
      },
      beforeMount() {
        console.log("%c Description.vue beforeMount(start)", this.$ud_store.state.consoleLog.component)
        console.log('this.$parent.isUsersIdea', this.$parent.isUsersIdea)
        console.log('this.currentIdeaDescription', this.currentIdeaDescription)
        if (this.$parent.isUsersIdea) {
          // init editor function(
          this.initialiseEditor()
        } else {
          this.initialiseViewer()
          // init view  function()  
        }
        // this.initialiseDesc();
        
        console.log("%c Description.vue beforeMount(end)", this.$ud_store.state.consoleLog.component)
      },
      mounted() {
        console.log("%c Description.vue mounted(start)", this.$ud_store.state.consoleLog.component)
        console.log('this.$ud_store.getters.getUserData => ', )
        console.log("%c Description.vue (this.$parent.isUsersIdea)", this.$parent.isUsersIdea)
        // console.log('editor => ', editor)
        // this.updateDescription();
        
        console.log("%c Description.vue mounted(end)", this.$ud_store.state.consoleLog.component)
      },
      methods: {
        onBlur(val) {
          console.log('onBlur')
          let newContent = val.getMarkdown();
          this.$parent.description_to_update = newContent;
          console.warn('this.$parent.description_to_update => ', this.$parent.description_to_update)
        },
        initialiseViewer() {
          console.log("%c initialiseViewer", this.$ud_store.state.consoleLog.component)
          var editor = Editor.factory({
            el: document.querySelector('#editSection'),
            viewer: true,
            initialValue: this.currentIdeaDescription,
          });
        },
        initialiseEditor() {
          console.log("%c initialiseEditor", this.$ud_store.state.consoleLog.component)
          var editor = new Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '740px',
            initialValue: this.currentIdeaDescription,
            events: {
              blur: () => this.onBlur(editor)
            }
          });
        },
        updateDescription() {
          console.warn('run setDescription Func', this.$ud_store.getters.getCurrentIdea)
          editor = new Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '740px',
            initialValue: 'this.currentIdeaDescription',
            // initialValue: this.$ud_store.getters..description,
            events: {
              blur: () => this.onBlur(editor)
            }
          });
        },
      }
    }
</script>