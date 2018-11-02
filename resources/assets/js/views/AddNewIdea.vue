<template>
    <div class="container">
        <div class="wrapper">
            <div  class="form-wrapper">
                <div>
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
                                        <v-select v-model="idea.category" placeholder="Category" label="category" :options="options_category"></v-select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="tags">
                                <label for="tags">Tags</label>

                                <div class="tags_select">
                                    <input-tag v-model="idea.tags" placeholder="+"></input-tag>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="tab-nav-wrapper fixed_width"> 
                        <div>
                            <div class='tab-nav-item'>
                                Description
                            </div>
                        </div>
                    </div>
                    
                    <div class="editSection fixed_width" id="editSection" />

                    <div class="form-group post-idea-container fixed_width">
                        <div>
                            <button type="submit" class="post-idea" @click="handleSubmit">
                                <p>Post Idea</p>
                            </button>
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</template>

<style lang="scss">

@import '~@/_variables.scss';

.vue-input-tag-wrapper {
    background-color: teal;
}
.input-tag {
    border-radius: 50px;
    background-color: black;
    color: white;
}

.tab-nav-wrapper {
    min-height: 75px;
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
    padding: 48px 0;
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
        /* width: 100%; */
        margin: 0 auto;
        
        #title {
            div {
                input {
                    font-size: 64px;
                    font-weight: $w-bold;
                    color: $black;
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
                    color: $black-light;
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
            button {
                display: none;
            }
            > div {
                > div {
                    > div {
                        border-radius: 0px;
                        border: none;
                        border-bottom: 2px solid $black;
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
            width: 428px;
            font-size: 14px;
            color: $black;
            margin: 16px 0;
            
            .tags_select {
                width: 100%;
                color: white;
                margin: 8px 0;
                background-color: transparent;
                /* display: inline-flex; */
                border-bottom: 2px solid $black;
                > div {
                    border: none;
                    .input-tag {
                        background-color: $black;
                        color: white;
                        border-radius: 50px;
                        padding: 4px 12px;
                        border: none;
                        .remove {
                            color: white;
                        }
                    }
                    input {
                        border-radius: 0px;
                        border: none;
                        color: $grey-dark;
                        border-radius: 50px;
                        margin-left: 8px;
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
                    status: '',
                    category: '',
                    tags: [],
                    description: 'initial val',
                },
                options_category: [
                    { category: this.$capitalise(this.$ud_store.state.categories[0]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[1]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[2]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[3]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[4]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[5]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[6]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[7]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[8]) },
                    { category: this.$capitalise(this.$ud_store.state.categories[9]) }
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
        mounted() {
            this.setDescription(this.idea.description);
        },
        update() {
            this.setDescription(this.idea.description);
        },
        methods: {
            // delays updating the rendered markdown input
            onBlur(val) {
                console.log('onBlur')
                let newContent = val.getMarkdown();
                this.idea.description = newContent;
            },
            setDescription() {
                console.warn('run setDescription Func')
                var editor = new Editor({
                    el: document.querySelector('#editSection'),
                    initialEditType: 'wysiwyg',
                    previewStyle: 'vertical',
                    // height: '600px',
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
                console.log('status', this.idea.status)
                console.log('category', this.idea.category)
                console.log(
                    'title', this.idea.title,
                    'pitch', this.idea.pitch,
                    'status', this.idea.status.status,
                    'category', this.idea.category.category,
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
                            category: this.idea.category.category,
                            status: this.idea.status.status,
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
                        this.$router.push({ path: `/idea/${res.data.id}`})
                        
                        console.log('run this.handleGetIdeaData()');
                        // this.handleGetIdeaData()
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