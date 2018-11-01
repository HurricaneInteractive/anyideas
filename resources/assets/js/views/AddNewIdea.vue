<template>
    <div class="container">
        <div class="wrapper">

            <!-- <button @click="handleGetIdeaData">get all idea data</button> -->
            <div v-if="this.$ud_store.state.data.loggedIn !== true" class="please_log_in">
                <p>Hi user - please login to start sharing your ideas with the world</p>
            </div>

            <div v-else class="form-wrapper ">
                <form>
                <!-- <form method="POST"> -->
                    <header class="header-container">
                        <div class="header-wrapper fixed_width">
                            <div class="form no-label" id="title">
                                <label for="title">Name of Idea</label>
                                <div>
                                    <input placeholder="Name of Idea" type="text" class="input_reset" v-model="idea.title" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row no-label" id="elevator">
                                <label for="pitch">Elevator Pitch (240 Characters)</label>

                                <div>
                                    <textarea placeholder="Elevator Pitch (240 Characters)" type="text" class="input_reset" v-model="idea.pitch" required/>
                                </div>
                            </div>

                            <div class="status_category">
                                <div class="form-group row no-label" id="status">
                                    <label for="status">Status</label>

                                    <div>
                                        <v-select placeholder="Status" label="status" :options="options"></v-select>
                                    </div>
                                </div>

                                <div class="form-group row no-label" id="category">
                                    <label for="category">Category</label>
                                    <div>
                                        <v-select placeholder="Category" label="categories" :options="options_category"></v-select>
                                    </div>
                                </div>
                            </div>

                            <!-- get array out of data... somehow -->
                            <div class="form-group row" id="tags">
                                <label for="tags">Tags</label>

                                <div>
                                    <button>Tags</button>
                                    <v-select searchable=false noDrop=true clearSearchOnSelect=false multiple taggable push-tags placeholder="Tags go here" label="tags"></v-select>
                                    <!-- <input id="tags" type="text" class="form-control" v-model="idea.tags"> -->
                                </div>
                            </div>
                        </div>
                    </header>

                    <TabNav v-bind:props="tab_nav"/>

                    <div class="form-group row fixed_width" id="description_container">

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
@import '~@/_variables.scss';

.form-wrapper {
    .no-label {
        label {
            display: none;
        }
    }
}
.input_reset {
    -webkit-appearance: none;
    border: none;
    background-color: transparent;
}
.header-container {
    width: 100%;
    background-color: $white;
    padding: 48px;
    .header-wrapper {
        width: 100%;
        margin: 0 auto;
        
        #title {
            div {
                input {
                    font-size: 64px;
                    font-weight: $w-bold;
                    color: $grey-dark;
                }
            }
        }
        #elevator {
            margin: 24px 0 0;
            div {
                display: flex;
                align-content: flex-start;
                justify-content: flex-start;
                textarea {
                    color: $grey-med;
                    min-width: 448px; 
                    height: 148px;
                    font-family: $font-family-sans-serif;
                }
            }
        }
        .status_category {
            width: 256px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 16px;
        }
        #status, #category {
            /* width: 148px; */
            font-size: 12px;
            color: black;
            > div {
                > div {
                    > div {
                        border-radius: 0px;
                        border: none;
                        border-bottom: 2px solid black;
                    }
                }
            }
        }
        .v-select.single .selected-tag {
            background-color: transparent;
            border-color: transparent;
            position: absolute;
        }
        #tags {
            width: 256px;
            font-size: 14px;
            color: black;
            margin: 16px 0;
            > div {
                width: 100%;
                color: white;
                margin: 8px 0;
                /* display: inline-flex; */
                > div {
                    > div {
                        border-radius: 0px;
                        border: none;
                    }
                }
            }
        }
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
                    title: '',
                    pitch: '',
                    category: '',
                    tags: '',
                    description: 'Add Description',
                    status: 'Status'
                },
                options_category: [
                    { categories: this.$capitalise(this.$ud_store.state.categories[0]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[1]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[2]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[3]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[4]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[5]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[6]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[7]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[8]) },
                    { categories: this.$capitalise(this.$ud_store.state.categories[9]) }
                ],
                options: [
                    { status: this.$ud_store.state.status[0] },
                    { status: this.$ud_store.state.status[1] },
                    { status: this.$ud_store.state.status[2] },
                    { status: this.$ud_store.state.status[3] },
                    { status: this.$ud_store.state.status[4] },
                    { status: this.$ud_store.state.status[5] },
                    { status: this.$ud_store.state.status[6] },
                    { status: this.$ud_store.state.status[7] }
                ],
                tab_nav: [
                    {
                        id: 'description',
                        label: 'Description',
                        route: null,
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
                ideaData: [],
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
        updated() {
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

            handleGetIdeaData() {
                console.log('IDEA SUBMITTED')
            },

            handleSubmit() {
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
                    .then(res => {
                        console.warn('​handleSubmit -> response', res);
                        // if (response.status === 200) {
                        //     window.location = '/';
                        // }
                        console.log('run this.handleGetIdeaData()');
                        this.handleGetIdeaData()
                    })
                    .catch(error => {
                        console.log('érror is coming')
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