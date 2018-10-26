<template>
    <div class="container">
        <div class="wrapper">

            <!-- <button @click="handleGetIdeaData">get all idea data</button> -->
            <div class="form-wrapper ">
                <form method="POST">
                    <header class="header-container">
                        <div class="header-wrapper fixed_width">
                            <div class="form no-label">
                                <label for="title">Name of Idea</label>
                                <div>
                                    <input value="Name of Idea" id="title" type="text" class="form-control" v-model="idea.title" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row no-label" >
                                <label for="pitch">Elevator Pitch (240 Characters)</label>

                                <div>
                                    <input value="Elevator Pitch (240 Characters)" id="pitch" type="text" class="form-control" v-model="idea.pitch" required>
                                </div>
                            </div>

                            <div class="form-group row no-label">
                                <label for="status">Status</label>

                                <div>
                                    <input value="pre-alpha 0.0.0.1" id="status" type="text" class="form-control" v-model="idea.status" required>
                                </div>
                            </div>

                            <div class="form-group row no-label">
                                <label for="category">Category</label>

                                <div >
                                    <!-- <input type="text" class="form-control" > -->
                                    <select id="category" v-model="idea.category" name="cars">
                                        <option value="aec">Arts, Entertainment & Culture</option>
                                        <option value="law">Life & Well-being</option>
                                        <option value="ib">Industry & Business</option>
                                        <option value="its">Innovation, Technology & Science</option>
                                    </select>
                                </div>
                            </div>

                            <!-- get array out of data... somehow -->
                            <div class="form-group row">
                                <label for="tags">Tags</label>

                                <div>
                                    <input id="tags" type="text" class="form-control" v-model="idea.tags">
                                </div>
                            </div>
                        </div>
                    </header>

                    <TabNav v-bind:props="tab_nav"/>

                    <div class="form-group row fixed_width">

                        <div class="description_input" id="editor">
                            <div class="form-control editSection" :value="idea.description" @input="update" id="description" type="text" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div>
                            <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                Post Idea
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

.form-wrapper {
    .no-label {
        label {
            display: none;
        }
    }
}
.header-container {
    width: 100%;
    background-color: $white;
    padding: 48px;
    .header-wrapper {
        margin: 0 auto;
    }
}
.description_input {
    width: 100%;
    margin: 48px 0;
    textarea {
        width: 100%;
    }   
}

</style>

<script>
    // import lodash from 'lodash'
    require('codemirror/lib/codemirror.css') // codemirror
    require('tui-editor/dist/tui-editor.css'); // editor ui
    require('tui-editor/dist/tui-editor-contents.css'); // editor content
    require('highlight.js/styles/github.css'); // code block highlight

    var Editor = require('tui-editor');
    import TabNav from '../components/TabNav'
    export default {
        name: 'AddNewIdea',
        components: {
            TabNav
        },
        data() {
            return {
                idea: {
                    title: 'Name of Idea',
                    pitch: 'Elevator Pitch (240 Characters)',
                    category: 'Category',
                    tags: '',
                    description: 'Add Description',
                    status: 'status'
                },
                tab_nav: [
                    {
                        id: 'description',
                        label: 'Description',
                        route: '/add-new-idea',
                        active: 'true',
                    },
                    // {
                    //     id: 'timeline',
                    //     label: 'Timeline',
                    //     route: '',
                    //     active: 'false',
                    // },
                    // {
                    //     id: 'discussion',
                    //     label: 'Discussion',
                    //     route: '',
                    //     active: 'false',
                    // },
                    // {
                    //     id: 'updates',
                    //     label: 'Updates',
                    //     route: '',
                    //     active: 'false',
                    // }
                ],
                errors: [],
                ideas: []
            }
        },
        computed: {
            // handles the description input as markdown
            compiledMarkdown: function () {
                return marked(this.idea.description, { sanitize: true })
            }
        },
        mounted() {
            console.log('AddNewIdea.vue page');
            // console.log(this.idea.tags);
            this.setDescription();
        },
        methods: {
            // delays updating the rendered markdown input
            setDescription() {
                
                console.warn('run setDescription Func')
                console.log('run =>', this.$ud_store.state.idea.description )
                // var viewer = Editor.factory({
                //     el: document.querySelector('#viewerSection'),
                //     viewer: true,
                //     height: '500px',
                //     initialValue: 'Add Description (use markdown)'
                // });
                var editor = new Editor({
                    el: document.querySelector('#description'),
                    initialEditType: 'wysiwyg',
                    previewStyle: 'vertical',
                    height: '300px',
                    initialValue: 'Add Description (use markdown)'
                });
                this.loaded = true;
            },

            // on click gets titles of all ideas and console logs them
            handleGetIdeaData() {
                axios.get('/ai/idea-get-all').then( (response) => {
                    this.ideaData = response.data
                    console.log('​handleGetIdeaData -> this.ideaData', this.ideaData);
                })
            },
            handleSubmit(e) {
                e.preventDefault()

                if (this.title !== '' && this.description !== null && this.pitch !== null && this.status !== null) {
                    axios({
                        method: 'POST',
                        url: '/ai/idea/create',
                        data: {
                            title: this.idea.title,
                            category: this.idea.category,
                            tags: this.idea.tags,
                            description: this.idea.description,
                            pitch: this.idea.pitch,
                            status: this.idea.status
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        }
                    })
                    .then(response => {
                        console.log('​handleSubmit -> response', response);
                        if (response.status === 200) {
                            window.location = '/';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
                } else {
                    console.log('maaaaate');
                    return alert('make sure you fill in all the fields');
                }
            }
        }

    }
</script>