<template>
  <section class="description">
    <h2>Description Goes Below</h2>
    <p v-html="this.$ud_store.state.idea.description"></p>
    <div id="viewerSection"/>

    <hr/>

    <h4>if this is the users idea</h4>
    <div class="editSection" id="editSection"/>
  </section>
</template>

<script>
    require('codemirror/lib/codemirror.css') // codemirror
    require('tui-editor/dist/tui-editor.css'); // editor ui
    require('tui-editor/dist/tui-editor-contents.css'); // editor content
    require('highlight.js/styles/github.css'); // code block highlight

    var Editor = require('tui-editor');
    export default {
      name: 'Description',
      data() {
        return {
          loaded: false
        }
      },
      mounted() {
        console.log('Description.vue')
        this.setDescription();
      },
      methods: {
        setDescription() {
          console.warn('run setDescription Func')
          console.log('run =>', this.$ud_store.state.idea.description )
          var viewer = Editor.factory({
            el: document.querySelector('#viewerSection'),
            viewer: true,
            height: '500px',
            initialValue: this.$ud_store.state.idea.description
          });
          var editor = new Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '300px',
            initialValue: this.$ud_store.state.idea.description
          });
          this.loaded = true;
        }
      }
    }
</script>