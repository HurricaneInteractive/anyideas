<template>
    <div class="container">
        <div class="wrapper">

            <!-- <button @click="handleGetIdeaData">get all idea data</button> -->
            

            <div  class="form-wrapper">
                <div>
                <!-- <div method="POST"> -->
                    <header class="header-container">
                        <div class="header-wrapper fixed_width">
                            <div class="form no-label" id="title">
                                <label for="title">Name of Idea</label>
                                <div>
                                    <input placeholder="Name of Idea" type="text" class="input_reset" v-model="idea.title" required>
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
                                        <v-select v-model="idea.status" placeholder="Status" label="status" :options="options_status"></v-select>
                                    </div>
                                </div>

                                <div class="form-group row no-label" id="category">
                                    <label for="category">Category</label>
                                    <div>
                                        <v-select v-model="idea.category" placeholder="Category" label="categories" :options="options_category"></v-select>
                                    </div>
                                </div>
                            </div>

                            <!-- get array out of data... somehow -->
                            <div class="form-group row" id="tags">
                                <label for="tags">Tags</label>

                                <div class="tags_select">
                                    <input-tag v-model="idea.tags" placeholder="+"></input-tag>
                                    <!-- <v-select :options="['tags']" v-model="idea.tags" noDrop multiple taggable push-tags label="tags"></v-select> -->
                                    <!-- <v-select v-model="idea.tags" :options="idea.tags" multiple taggable push-tags></v-select> -->
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- <TabNav v-bind:props="tab_nav"/> -->
                    <div class="tab-nav-wrapper"> 
                        <div>
                            <div class='tab-nav-item'>
                                Description
                            </div>
                        </div>
                    </div>
                    
                    <!-- eslint-disable-next-line vue/valid-v-model -->`
                    <div class="editSection" id="editSection" />
                    <!-- <div id="viewerSection"/> -->
                    
                            <!-- <div class="form-control editSection" :value="idea.description" @input="update" id="editSection"/> -->
                    <div class="form-group post-idea-container fixed_width">
                        <div>
                            <button type="submit" class="post-idea" @click="handleSubmit">
                                <p>Post Idea</p>
                            </button>
                        </div>
                    </div>

                    
                </div>

                <button @click="consoleLogMe">
                    COnsole log sHizZzzz
                </button>
            </div>

            <!-- <div v-else class="please_log_in">
                <p>Hi user - please login to start sharing your ideas with the world</p>
            </div> -->


        </div>
    </div>
</template>

<style lang="scss" scoped>

@import '~@/_variables.scss';

.tab-nav-wrapper {
    min-height: 75px;
    width: 100%;
    display: grid;
    align-items: center;
    div {
        text-align: center;
        padding: 24px 0;
        text-decoration: none;
        color: $black-light;
        border-bottom: 2px solid black;
        font-weight: $w-bold;
    }
}
.tui-editor-defaultUI {
    border: none;
}
.vue-input-tag-wrapper {
    background-color: transparent;
}
.please_log_in {
    width: 100%;
    padding: 25vh 25%;
    text-align: center;
}
.form-wrapper {
    .no-label {
        label {
            display: none;
        }
    }
}
.post-idea-container {
    padding: 0 0 48px;
    > div {
        display: flex;
        justify-content: flex-end;
        button {
            margin-left: 8px;
        }
    }
}
.post-idea {
    display: inline-flex;
    background-color: $primary;
    color: $pure;
    align-content: center;
    justify-content: center;
    border-radius: 25px;
    padding: 0 16px;
    text-decoration: none;
    border: none;
    > span {
        display: grid;
        align-content: center;
        justify-content: center;
        svg {
            width: 18px;
            height: 18px;
        }
    }
    p {
        margin: 8px;
        color: $pure;
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
            .tags_select {
                width: 100%;
                color: white;
                margin: 8px 0;
                /* display: inline-flex; */
                > div {
                    > div {
                        border-radius: 0px;
                        border: none;
                        border-bottom: 2px solid black;
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

    export default {
        name: 'AddNewIdea',
        data() {
            return {
                loaded: false,
                idea: {
                    title: '',
                    pitch: '',
                    status: null,
                    category: null,
                    tags: [],
                    description: 'initial val',
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
                options_status: [
                    { status: this.$ud_store.state.status[0] },
                    { status: this.$ud_store.state.status[1] },
                    { status: this.$ud_store.state.status[2] },
                    { status: this.$ud_store.state.status[3] },
                    { status: this.$ud_store.state.status[4] },
                    { status: this.$ud_store.state.status[5] },
                    { status: this.$ud_store.state.status[6] },
                    { status: this.$ud_store.state.status[7] }
                ],
                ideaData: [],
            }
        },
        // computed: {
        //     // handles the description input as markdown
        //     compiledMarkdown: function () {
        //         return marked(this.idea.description, { sanitize: true })
        //     }
        // },
        mounted() {
            console.log('AddNewIdea.vue page');
            // console.log(this.idea.tags);
            console.log(this.$ud_store.state.current_user_view.user)
            console.log('this.idea.tags => ', this.idea.tags)
            console.log('this.idea.description => ', this.idea.description)
            
            this.setDescription(this.idea.description);
        },
        update() {
            this.setDescription(this.idea.description);
        },
        methods: {
            consoleLogMe() {
                console.log('fk u')
                console.log(
                    'title', this.idea.title,
                    'pitch', this.idea.pitch,
                    'status', this.idea.status,
                    'category', this.idea.category,
                    'tags', this.idea.tags,
                    'tags stringify', JSON.stringify(this.idea.tags),
                    'description', this.idea.description
                )
            },
            // delays updating the rendered markdown input
            setNewDescriptionVal(val) {
                console.log('new value => ', val)
            },
            onBlur(val) {
                console.log('onBlur')
                let newContent = val.getMarkdown();
                this.idea.description = newContent;
            },
            setDescription() {
                console.warn('run setDescription Func')
                var editor = new Editor({
                    el: document.querySelector('#editSection'),
                    initialEditType: 'markdown',
                    previewStyle: 'vertical',
                    // height: '600px',
                    // initialValue: '# this.$ud_store.state.current_user_view.user_meta.bio'
                    initialValue: this.idea.description,
                    events: {
                        blur: () => this.onBlur(editor),
                    }
                });
                this.loaded = true;
            },

            handleGetIdeaData() {
                console.log('IDEA SUBMITTED')
            },

            handleSubmit() {
                console.log(
                    'title', this.idea.title,
                    'pitch', this.idea.pitch,
                    'status', this.idea.status,
                    'category', this.idea.category,
                    'tags', this.idea.tags,
                    'tags stringify', JSON.stringify(this.idea.tags),
                    'description', this.idea.description
                )
                if (this.idea.title !== '' && this.idea.description !== null && this.idea.pitch !== null && this.idea.status !== null) {
                    axios({
                        method: 'POST',
                        url: '/ai/idea/create',
                        data: {
                            title: this.idea.title,
                            pitch: this.idea.pitch,
                            category: this.idea.category,
                            status: this.idea.status,
                            tags: JSON.stringify(this.idea.tags),
                            description: this.idea.description,
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