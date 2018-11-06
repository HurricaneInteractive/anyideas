<template>
    <div class="markdown-wrapper">
        <template v-if="editing">
            <markdown-editor :value="content" ref="markdownEditor" :configs="configs" @input="$emit('update', $event)"></markdown-editor>
        </template>
        <template v-else>
            <div class="markdown-content" v-html="markdownContent" />
        </template>
    </div>    
</template>

<style lang="scss" scoped>
    @import '~simplemde/dist/simplemde.min.css';
    @import '~@/_variables.scss';

    .markdown-content {
        font-size: 1em;
        color: $black;
        h1, h2, h3, h4, h5, h6 {
            padding: 0;
            border: none;
        }
        * {
            color: inherit;
            box-sizing: border-box;
        }

        hr {
            max-width: 320px;
            margin: 40px auto;
            border-color: $black;
        }

        blockquote {
            margin: 30px 0 30px 0;
            border-color: $black;
            * {
                font-style: italic;
            }
        }
    
        > *:first-child {
            margin-top: 0;
        }
        > *:last-child {
            margin-bottom: 0;
        }
    }
</style>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'
    import marked from 'marked'
    
    export default {
        name: 'GlobalEditor',
        components: {
            markdownEditor
        },
        props: {
            content: {
                type: String,
                default: ""
            },
            editing: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                configs: {
                    hideIcons: ['image', 'link', 'preview']
                }
            }
        },
        methods: {
            check(e) {
                console.log(e);
            }
        },
        computed: {
            markdownContent() {
                return marked(this.content, {
                    sanitize: true
                })
            }
        }
    }
</script>
