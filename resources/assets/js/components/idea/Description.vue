<template>
  <section class="description">
    <h2>Description Goes Below</h2>
    <p v-html="this.$ud_store.state.idea.description"></p>
    <div id="viewerSection"></div>
    <div class="editSection" id="editSection">
      .md editor
    </div>
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
      mounted() {
        // console.log('Description (this.props.description) => ', this);
      },
      methods: {
        setDescription() {
          var editor = new Editor({
            el: document.querySelector('#editSection'),
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '300px',
            initialValue: this.$ud_store.state.idea.description
          });
          var viewer = Editor.factory({
            el: document.querySelector('#viewerSection'),
            viewer: true,
            height: '500px',
            initialValue: this.$ud_store.state.idea.description
          });
        }
      }
    }
</script>