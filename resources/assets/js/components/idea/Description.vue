<template>
  <section class="description fixed_width">    
    <!-- <div id="editSection"/> -->

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
        setDescription() {
          
          console.warn('run setDescription Func')
          // console.log('run =>', this.$ud_store.state.idea.description )
          if (this.$parent.isUsersIdea) {
            console.log('this.$parent.isUsersIdea TRUE')
            var editor = new Editor({
              el: document.querySelector('#editSection'),
              initialEditType: 'wysiwyg',
              previewStyle: 'vertical',
              height: '740px',
              initialValue: this.$ud_store.state.idea.description
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

          // console.log('this.markdown_id (BEFORE) => ', this.markdown_id)
          // if (this.$parent.idea_data.user_id === this.$ud_store.state.data.user_data.id) {
          //   console.log('values match - this is the users idea');
          //   this.markdown_id = 'editSection';
          //   console.log('TCL: setDescription -> this.markdown_id', this.markdown_id);

          //   editor = new Editor({
          //     el: document.querySelector('#editSection'),
          //     initialEditType: 'wysiwyg',
          //     previewStyle: 'vertical',
          //     height: '300px',
          //     initialValue: this.$parent.idea_data.description
          //   });
          //   // this.changeMarkdownValue('editSection')
          // }
        }
      }
    }
</script>