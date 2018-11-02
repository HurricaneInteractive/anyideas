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
      mounted() {
        console.log("%c Description.vue", this.$ud_store.state.consoleLog.component)
        this.setDescription();
      },
      methods: {
        onBlur(val) {
          console.log('onBlur')
          let newContent = val.getMarkdown();
          this.$parent.description_to_update = newContent;
          console.warn('this.$parent.description_to_update => ', this.$parent.description_to_update)
        },
        setDescription() {
          console.warn('run setDescription Func')
          if (this.$parent.isUsersIdea) {
            console.log('this.$parent.isUsersIdea TRUE')
            var editor = new Editor({
              el: document.querySelector('#editSection'),
              initialEditType: 'wysiwyg',
              previewStyle: 'vertical',
              height: '740px',
              initialValue: this.$ud_store.state.idea.description,
              events: {
                blur: () => this.onBlur(editor),
              }
            });
          } else {
            console.log('this.$parent.isUsersIdea FALSE')
            var editor = Editor.factory({
              el: document.querySelector('#editSection'),
              viewer: true,
              initialValue: this.$ud_store.state.idea.description
            });
          }
          this.loaded = true;
        },
      }
    }
</script>