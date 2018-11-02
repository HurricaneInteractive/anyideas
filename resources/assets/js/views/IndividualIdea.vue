<template>
    <div class="container">
        <div class="row">

            <header class="header-container">
                <div class="header-wrapper fixed_width">
                    <div id="title">
                        <h2>{{idea_data.title}}</h2>
                    </div>

                    <div id="elevator">
                        <p>{{idea_data.pitch}}</p>
                    </div>

                    <section class="meta_data">
                        <ul>
                            <li class="category"><router-link :to="`/category/${idea_data.category}`">{{idea_data.category}}</router-link></li>
                            <li :class="'status bg_' + idea_data.status">{{idea_data.status}}</li>
                            <li class="tags" v-for="(value, key) in JSON.parse(idea_data.tags)" :key="key">
                                {{value}}
                            </li>
                        </ul>
                    </section>
                </div>
            </header>

            <TabNav v-bind:props="tab_nav"/>

            <router-view>
                <!-- Description / Timeline / Discussion / Updates here -->
            </router-view>
        </div>
    </div>
</template>

<style lang="scss">
    @import '~@/App.scss';

.meta_data {
    > ul {
        list-style-type: none;
        display: inline-flex;
        padding: 0;
        margin: 0;
        .category {
            background-color: $black;
            margin-left: 0;
        }
        .status, .category {
            font-weight: $w-bold;
        }
        .tags {
            border: 1px solid $black;
            color: $black;
        }
        > li {
            padding: 8px 16px;
            margin: 0 4px;
            border-radius: 25px;
            color: $white;
            @include fontSize(12px);
            a {
                text-decoration: none;
                color: $white;
            }
        }
    } 
}

.header-container {
    width: 100%;
    background-color: $white;
    padding: 48px;
    .header-wrapper {
        /* width: 100%; */
        margin: 0 auto;
        
        #title {
            h2 {
                margin: 8px 0;
                font-size: 64px;
                font-weight: $w-bold;
                color: $black;
            }
        }
        #elevator {
            display: flex;
            align-content: flex-start;
            justify-content: flex-start;
            margin: 16px 0 24px;
            p {
                margin: 0;
                color: $black-light;
                width: 448px;
                font-family: $font-family-sans-serif;
            }
        }
    }
}

.idea_navigation {
    width: 100%;
    > ul {
        display: inline-flex;
        margin: 0 auto;
        width: 100%;
        
        list-style-type: none;
        .active {
            border-bottom: 2px solid $grey-dark;
        }
        > li {
            padding: 4px;
            
            font-size: $size-p;
            color: $p-color;
            border-bottom: 2px solid $white;
            a {
                text-decoration: none;
                margin: 0 4px;
            }
        }
    }
}
</style>

<script>
    import marked from 'marked'
    import TabNav from '../components/TabNav'

    require('codemirror/lib/codemirror.css') // codemirror
    require('tui-editor/dist/tui-editor.css'); // editor ui
    require('tui-editor/dist/tui-editor-contents.css'); // editor content
    require('highlight.js/styles/github.css'); // code block highlight

    var Editor = require('tui-editor');

    import Description from '../components/idea/Description'
    import Timeline from '../components/idea/Timeline'
    import Updates from '../components/idea/Updates'
    import Discussion from '../components/idea/Discussion'
    export default {
        props: ['props'],
        components: {
            Description, Timeline, Updates, Discussion, TabNav
        },
        data() {
            return {
                idea_data: '',
                idea_id: '5678',
                subNavActive: 'Description',
                timeline: {
                    title: '',
                    message: ''
                },
                discussion: {
                    title: '',
                    message: ''
                },
                timeline_update: {
                    title: '',
                    message: '',
                },
                discussion_update: {
                    id: '',
                    title: '',
                    message: '',
                },
                update_post: {
                    title: '',
                    message: ''
                },
                update_post_update: {
                    id: '',
                    title: '',
                    message: ''
                },
                timeline_data: '',
                discussion_data: '',
                updates_post_data: '',
                discussion_replies_data: '',
                errors: [],
                ideas: [],
                tab_nav: [
                    {
                        id: 'description',
                        label: 'Description',
                        route: '/add-new-idea',
                        active: this.$route.name === 'description' ? true : false
                    },
                    {
                        id: 'timeline',
                        label: 'Timeline',
                        route: '',
                        active: this.$route.name === 'timeline' ? true : false,
                    },
                    {
                        id: 'discussion',
                        label: 'Discussion',
                        route: '',
                        active: this.$route.name === 'discussion' ? true : false,
                    },
                    {
                        id: 'updates',
                        label: 'Updates',
                        route: '',
                        active: this.$route.name === 'updates' ? true : false,
                    }
                ],
            }
        },
        beforeMount() {
            console.log("%c IndividualIdea.vue", this.$ud_store.state.consoleLog.component)
            this.$ud_store.commit('SET_IDEA_ID', this.$route.params.id );
            this.handeGetInitialData();
            this.setAsActive();
        },
        watch: {
            $route: ["setAsActive"]
        },
        methods: {
            // re-sets the current active tab_nav item
            setAsActive() {
                this.tab_nav = [
                    {
                        id: 'description',
                        label: 'Description',
                        route: '/add-new-idea',
                        active: this.$route.name === 'description' ? true : false
                    },
                    {
                        id: 'timeline',
                        label: 'Timeline',
                        route: '',
                        active: this.$route.name === 'timeline' ? true : false,
                    },
                    {
                        id: 'discussion',
                        label: 'Discussion',
                        route: '',
                        active: this.$route.name === 'discussion' ? true : false,
                    },
                    {
                        id: 'updates',
                        label: 'Updates',
                        route: '',
                        active: this.$route.name === 'updates' ? true : false,
                    }
                ];
            },
            handeGetInitialData() {
                console.log('TCL: handeGetInitialData -> handeGetInitialData');
                axios.post('/ai/idea/get/' + this.$route.params.id)
                .then(response => {
                    this.idea_data = response.data;
                    this.$ud_store.commit('SET_IDEA_DESCRIPTION', response.data.description );
                });
            },
            handleDeleteIdea(e) {
                e.preventDefault();
                axios.post('/ai/idea/delete/' + this.$route.params.id)
                    .then(response => {
                        console.log('TCL: handleDeleteIdea -> response', response);
                });
            },

            // // updates post functions
            // handleUpdatePostDarts(value) {
            //     axios({
            //         method: 'POST',
            //         url: '/ai/idea/update_post/darts/add/' + value,
            //         headers: {
            //             'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            //         }
            //     });
            // },
            // hanldeGetUpdateData(e) {
            //     e.preventDefault();
            //     axios({
            //         method: 'POST',
            //         url: '/ai/idea/update_post/get/all/' + this.$route.params.id
            //     }).then( (response) => {
            //         this.updates_post_data = response.data;
            //     }); 
            // },
            // handleUpdatePostSubmit(e) {
            //     e.preventDefault();
            //     axios({
            //         method: 'POST',
            //         url: '/ai/idea/update_post/create/' + this.$route.params.id,
            //         data: {
            //             title: this.update_post.title,
            //             message: this.update_post.message
            //         }
            //     }).then( (response) => {
            //         this.discussion_data = response.data;
            //     });
            // },
            // handleUpdatePostDelete(value) {
            //     axios({
            //         method: 'POST',
            //         url: '/ai/idea/update_post/delete/' + value,
            //     }).then( (response) => {
            //         this.discussion_data = response.data;
            //     });
            // },
            // handleUpdatePostUpdate(e){
            //     e.preventDefault();
            //     let update_post_id = this.update_post_update.id;
            //     axios({
            //         method: 'POST',
            //         url: '/ai/idea/update_post/update/' + update_post_id,
            //         data: {
            //             title: this.update_post_update.title,
            //             message: this.update_post_update.message,
            //         },
            //     }).then( (response) => {
            //         if (response.data === "") {
            //             alert('error creating timeline entry');
            //         }
            //     });
            // },

            // discussion replies functions
            handleDiscussionReplyVote(reply_id) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/reply/darts/' + reply_id
                }).then( (response) => {
                    this.discussion_replies_data = response.data;
                });
            },
            handleDiscussionReplyDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/reply/delete/' + value,
                }).then( (response) => {
                    this.discussion_replies_data = response.data;
                });
            },
            handleDiscussionRepliesGet(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/reply/get/all/' + value
                }).then( (response) => {
                    this.discussion_replies_data = response.data;
                }); 
            },

            // discussion functions
            handleDiscussionDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/delete/' + value,
                }).then( (response) => {
                    this.discussion_data = response.data;
                });
            },
            handleDiscussionUpdate(e){
                e.preventDefault();
                let discussions_id = this.discussion_update.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/update/' + discussions_id,
                    data: {
                        title: this.discussion_update.title,
                        message: this.discussion_update.message,
                    },
                }).then( (response) => {
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },
            handleDiscussionSubmit(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/create/' + this.$route.params.id,
                    data: {
                        title: this.discussion.title,
                        message: this.discussion.message
                    }
                }).then( (response) => {
                    this.discussion_data = response.data;
                });
            },
            hanldeGetDiscussionData(e) {
                e.preventDefault();
                let idea_id = this.$route.params.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/get/' + idea_id
                }).then( (response) => {
                    this.discussion_data = response.data;
                });   
            },

            // timeline functions
            handleTimelineUpdate(e){
                let value = this.timeline_update.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/update/' + value,
                    data: {
                        title: this.timeline_update.title,
                        message: this.timeline_update.message,
                    },
                }).then( (response) => {
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },
            handleDartsAdd(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/darts/add/' + value,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                });
            },
            handleTimelineDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/delete/' + value,
                }).then( (response) => {
                    this.timeline_data = response.data;
                });
            },
            getTimelineData(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/get/' + this.$route.params.id,
                }).then( (response) => {
                    this.timeline_data = response.data;
                });
            },
            // timeline functions
            hanldeGetTimelineData(e) {
                e.preventDefault();
                let idea_id = this.$route.params.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/get/' + idea_id,
                }).then( (response) => {
                    this.timeline_data = response.data;
                });
            },
            handleTimelineSubmit(e){
                e.preventDefault();
                let idea_id = this.$route.params.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/create/' + idea_id,
                    data: {
                        title: this.timeline.title,
                        message: this.timeline.message,
                    },
                }).then( (response) => {
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },
        }

    }
</script>