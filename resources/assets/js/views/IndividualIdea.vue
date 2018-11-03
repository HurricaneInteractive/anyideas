<template>
    <div class="container">
        <div class="row">

            <header class="header-container">
                <div class="header-wrapper fixed_width">
                    <div id="title">
                        <h2>{{currentIdeaData.data.title}}</h2>
                        <h4>Posted by <router-link :to='"/user/" + currentIdeaData.user_data.id' >{{this.$capitalise(currentIdeaData.user_data.name)}}</router-link></h4>
                    </div>

                    <div id="elevator">
                        <p>{{currentIdeaData.data.pitch}}</p>
                    </div>

                    <section class="meta_data">
                        <ul>
                            <li class="category"><router-link :to="`/category/${currentIdeaData.data.category}`">{{currentIdeaData.data.category}}</router-link></li>
                            <li :class="'status bg_' + currentIdeaData.data.status">{{currentIdeaData.data.status}}</li>
                            <li class="tags" v-for="(value, key) in idea_current_tags" :key="key">
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

            <button @click="handleUpdateIdea">
                handleUpdateIdea
            </button>
        </div>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

.meta_data {
    display: flex;
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
            text-transform: uppercase;
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
                text-align: left;
                margin: 8px 0;
                font-size: 64px;
                font-weight: $w-bold;
                color: $black;
            }
            h4, a {
                text-align: left;
                margin: 8px 0;
                font-size: 16px;
                font-weight: $w-regular;
                color: $grey-dark;
                text-decoration: none;
                a {
                    color: $grey-dark;
                    transition: .5s;
                    &:hover {
                        color: $black;
                        transition: .5s;
                    }
                }
            }
        }
        #elevator {
            display: flex;
            align-content: flex-start;
            justify-content: flex-start;
            margin: 16px 0 24px;
            p {
                text-align: left;
                margin: 0;
                color: $black-light;
                width: 648px;
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
                isUsersIdea: false,
                subNavActive: 'Description',
                description_to_update: '',
                idea_current_tags: [],
                idea_current_description: '',
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
        computed: {
            currentUser() {
                return this.$ud_store.getters.getUserData.id
            },
            currentIdeaData() {
                return this.$ud_store.getters.getCurrentIdea
            },
            currentIdeaDescription() {
                return this.$ud_store.getters.getCurrentIdeaDescription
            }
        },
        beforeMount() {
            console.log("%c IndividualIdea.vue beforeMount(start)", this.$ud_store.state.consoleLog.component)
            console.warn('this.$ud_store.getters.getCurrentIdea => ', this.$ud_store.getters.getCurrentIdea)
            this.handeGetInitialData();
            this.setAsActive();
            console.log("%c IndividualIdea.vue beforeMount(end)", this.$ud_store.state.consoleLog.component)
        },
        mounted() {
             console.log("%c IndividualIdea.vue mounted(start)")
             this.testGettingGetter();
             console.log("%c IndividualIdea.vue mounted(end)")
        },
        watch: {
            $route: function(to, from) {
                if (to.params.id !== from.params.id) {
                    this.handleGetInitialData();
                    // handle get more data here;
                }

                // this.copy_successful = false
                this.setAsActive();
            }
        },
        methods: {
            // re-sets the current active tab_nav item
            testGettingGetter() {
                console.log('this.currentIdeaDescription => ', this.currentIdeaDescription)
                console.log('this.currentIdeaData => ', this.currentIdeaData)
                console.log('this.currentIdeaData => ', this.currentIdeaData.data)
                console.log('this.currentIdeaData => ', this.currentIdeaData.data.description)
                console.log('this.currentIdeaData => ', this.currentIdeaData.description)
            },
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
                console.log("%c IndividualIdea.vue handeGetInitialData(start)", this.$ud_store.state.consoleLog.component)
                console.log('TCL: handeGetInitialData -> idea_id', this.$route.params.id);
                axios({
                    method: 'POST',
                    url: '/ai/idea/get/' + this.$route.params.id,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                }).then(res => {
                    console.log('handeGetInitialData res => ', res)
                    console.log('handeGetInitialData res.data => ', res.data)

                    // SET_IDEA_DATA

                    this.idea_data = res.data;
                    this.idea_current_tags = JSON.parse(res.data.tags)
                    this.idea_current_description = res.data.description;
                    // this.$ud_store.commit('SET_IDEA_DATA', res.data );
                    this.$ud_store.commit('SET_IDEA_DATA', res.data );
                    this.$ud_store.commit('SET_IDEA_USER_ID', res.data.user_id );
                    this.$ud_store.commit('SET_IDEA_DESCRIPTION', res.data.description );

                    let res_user = res.data.user_id;
                    console.log('TCL: handeGetInitialData -> res_user', res_user);
                    let current_user = this.currentUser;
                    console.log('TCL: handeGetInitialData -> current_user', current_user);

                    if (res_user === current_user) {
                        this.isUsersIdea = true;
                        console.log('TCL: handeGetInitialData -> this.isUsersIdea', this.isUsersIdea);
                    }
                    axios({
                        method: 'POST',
                        url: '/ai/user/get/' + res.data.user_id,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                        }
                    }).then(res => {
                        console.log('user of current idea');
                        
                        this.$ud_store.commit('SET_IDEA_USER_INFO', res.data.user );
                    })
                });
                console.log("%c IndividualIdea.vue handeGetInitialData(end)", this.$ud_store.state.consoleLog.component)

            },
            handleDeleteIdea(e) {
                e.preventDefault();
                axios.post('/ai/idea/delete/' + this.$route.params.id)
                    .then(response => {
                        console.log('TCL: handleDeleteIdea -> response', response);
                });
            },

            handleUpdateIdea() {
                console.log('handleUpdateIdea')
                let updatedDescriptionVal = this.description_to_update;
                console.log('updatedDescriptionVal => ', updatedDescriptionVal)
                axios({
                    method: 'POST',
                    url: '/ai/idea/update/' + this.$route.params.id,
                    data: {
                        description: updatedDescriptionVal,
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                }).then(res => {
                    console.log('handleUpdateIdea res => ', res)
                    console.log('handleUpdateIdea res.data => ', res.data)

                    this.$ud_store.commit('SET_IDEA_DATA', res.data );
                    
                    // this.handeGetInitialData();
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