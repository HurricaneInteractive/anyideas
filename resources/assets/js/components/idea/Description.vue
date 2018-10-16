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
      props: ['props'],
      mounted() {
        console.warn("MOUNT CHILD (DESCRIPTION.VUE)")
        this.$nextTick(()=>{
          //execute your code
          console.log('Finished rendering the complete view')
        })
        // console.log('Description (this.props.description) => ', this);
        console.log('Description (this.$route.params.data) => ', this.$route.params)
        console.log('Description (this.$route.params.data) => ', this.$route)
        console.warn('Description (this.$ud_state) => ', $ud_state)
        console.log('Description (this.$ud_state) => ', $ud_state.state)
        console.log('Description (this.$ud_state.idea.description) => ', this.$ud_state.state.idea.description)
        this.setDescription();
      },
      methods: {
        setDescription() {
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
        }
      }
    }
</script>