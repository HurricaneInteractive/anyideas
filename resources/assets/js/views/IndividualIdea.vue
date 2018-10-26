<template>
    <div class="container">
        <div class="row">

            <header>
                <h1>{{idea_data.title}}</h1>
                <h4>Category: {{idea_data.category}}</h4>
                <div>Tags: {{idea_data.tags}}</div>
                <i>{{idea_data.status}}</i>
                <hr/>
                <p>Pitch: {{idea_data.pitch}}</p>
                <hr/>
            </header>

            <section class="meta_data">
                <ul>
                    <li class="category"><router-link to="index">{{idea_data.category}}</router-link></li>
                    <li :class="'status bg_' + idea_data.status"><router-link to="index">{{idea_data.status}}</router-link></li>
                    <li class="tags">tag</li>
                    <li class="tags">items</li>
                    <li class="tags">go</li>
                    <li class="tags">here</li>
                </ul>
            </section>

            <section class="idea_navigation">
                <ul>
                    <li v-on:click="setAsActive" ><router-link :to="{ name: 'description'}">Description</router-link></li>
                    <li v-on:click="setAsActive" ><router-link :to="{ name: 'timeline' }">Timeline</router-link></li>
                    <li v-on:click="setAsActive" ><router-link :to="{ name: 'discussion' }">Discussion</router-link></li>
                    <li v-on:click="setAsActive" ><router-link :to="{ name: 'updates' }">Updates</router-link></li>
                </ul>
            </section>

            <router-view>
                <!-- Description / Timeline / Updates here -->
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
        .category {
            background-color: $black;
        }
        .tags {
            background-color: $grey-med;
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
    var debounce = require('lodash.debounce');

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
            Description, Timeline, Updates, Discussion
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
                ideas: []
            }
        },
        beforeMount() {
            console.log("%c IndividualIdea.vue", this.$ud_store.state.consoleLog.component)
            this.$ud_store.commit('SET_IDEA_ID', this.$route.params.id );
            this.handeGetInitialData();
            // axios.post('/ai/idea/get/' + this.$route.params.id)
            // .then(response => {
            //     this.idea_data = response.data;
            //     this.$ud_store.commit('SET_IDEA_DESCRIPTION', response.data.description );
            //     console.warn('JUST SET STORE DESC');
            // });
        },
        methods: {
            setAsActive(event) {
                event.preventDefault();
                console.warn('set me as active => ', event)
                console.warn('set me as active => ', event.target)
                console.warn('set me as active => ', event.target.innerText)
                this.subNavActive = event.target.innerText;
            },
            handeGetInitialData() {
                console.log('TCL: handeGetInitialData -> handeGetInitialData');
                axios.post('/ai/idea/get/' + this.$route.params.id)
                .then(response => {
                    this.idea_data = response.data;
                    this.$ud_store.commit('SET_IDEA_DESCRIPTION', response.data.description );
                    console.warn('JUST SET STORE DESC');
                    console.log('response -> handeGetInitialData');
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