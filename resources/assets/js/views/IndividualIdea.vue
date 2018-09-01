<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <h1>{{idea_data.title}}</h1>
                        <h4>Category: {{idea_data.category}}</h4>
                        <div>Tags: {{idea_data.tags}}</div>
                        <i>{{idea_data.status}}</i>
                        <hr/>
                        <p>Pitch: {{idea_data.pitch}}</p>
                        <hr/>
                        <div>{{idea_data.description}}</div>
                        <button @click="handleDeleteIdea">DELETE IDEA</button>
                    </div>

                    <!-- update_post -->
                    <div>
                        <h3>Updates data</h3>
                        <button @click="hanldeGetUpdateData">get update_posts data from (pre filled) idea_id</button><br/><br/>   
                    
                        <form method="POST">
                            <div class="form-group row">
                                <label for="update_post.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="update_post.title" type="text" class="form-control" v-model="update_post.title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="update_post.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="update_post.message" type="text" class="form-control" v-model="update_post.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleUpdatePostSubmit">
                                    Post update_post update
                                </button>
                                </div>
                            </div>
                        </form>

                        <div id="updates_post_data">
                            <!-- @{{ updates_post_data }} -->
                            <ul v-for="(value, key) in this.updates_post_data" :key="key">
                                <li key={{key}}>
                                    <h4>{{value.title}}</h4>
                                    <p>{{value.message}}</p>
                                    <button @click="handleUpdatePostDelete(value.id)">Delete entry</button>
                                    <button @click="handleUpdatePostDarts(value.id)">{{value.darts}}</button>
                                </li>
                            </ul>
                        </div>

                        <h4>update_post item</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="update_post_update.id" class="col-md-4 col-form-label text-md-right">update_post id to update</label>

                                <div class="col-md-6">
                                <input id="update_post_update.id" type="text" class="form-control" v-model="update_post_update.id" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="update_post_update.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="update_post_update.title" type="text" class="form-control" v-model="update_post_update.title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="update_post_update.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="update_post_update.message" type="text" class="form-control" v-model="update_post_update.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleUpdatePostUpdate">
                                    Update updates_item
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr/>

                    <!-- discussion data -->
                    <div>
                        <h3>Discussions data</h3>
                        <button @click="hanldeGetDiscussionData">get discussion data from (pre filled) idea_id</button><br/><br/>   
                    
                        <form method="POST">
                            <div class="form-group row">
                                <label for="discussion.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="discussion.title" type="text" class="form-control" v-model="discussion.title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discussion.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="discussion.message" type="text" class="form-control" v-model="discussion.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleDiscussionSubmit">
                                    Post discussion update
                                </button>
                                </div>
                            </div>
                        </form>

                        <div id="discussion_data">
                            <!-- @{{ discussion_data }} -->
                            <ul v-for="(value, key) in this.discussion_data" :key="key">
                                <li key={{key}}>
                                    <h4>{{value.title}}</h4>
                                    <h6>{{value.id}}</h6>
                                    <p>{{value.message}}</p>
                                    <button @click="handleDiscussionDelete(value.id)">Delete entry</button>
                                    <button @click="handleDiscussionRepliesGet(value.id)">display no of replies</button>
                                </li>
                            </ul>
                            <div v-bind:style="{ paddingLeft: '48px'}">
                                <ul v-for="(value, key) in this.discussion_replies_data" :key="key">
                                    <li key={{key}}>
                                        <h4>{{value.title}}</h4>
                                        <h6>{{value.id}}</h6>
                                        <p>{{value.message}}</p>
                                        <button @click="handleDiscussionReplyVote(value.id)">Delete entry</button>
                                        <button @click="handleDiscussionReplyVote(value.id, 'down')">{{value.down_votes}} | Down</button>
                                        <button @click="handleDiscussionReplyVote(value.id, 'up')">{{value.up_votes}} | Up</button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h4>update discussion item</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="discussion_update.id" class="col-md-4 col-form-label text-md-right">Discussion item to update (ID)</label>

                                <div class="col-md-6">
                                <input id="discussion_update.id" type="text" class="form-control" v-model="discussion_update.id" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discussion_update.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="discussion_update.title" type="text" class="form-control" v-model="discussion_update.title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discussion_update.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="discussion_update.message" type="text" class="form-control" v-model="discussion_update.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleTimelineUpdate">
                                    Update discussion_update item
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr/>

                    <!-- timeline data -->
                    <div>
                        <h3>Timeline data</h3>
                        <button @click="hanldeGetTimelineData">get timeline data from (pre filled) idea_id</button><br/><br/>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="timeline.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="timeline.title" type="text" class="form-control" v-model="timeline.title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeline.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="timeline.message" type="text" class="form-control" v-model="timeline.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleTimelineSubmit">
                                    Post timeline update
                                </button>
                                </div>
                            </div>
                        </form>
                        <div id="timeline_data">
                            <!-- @{{ timeline_data }} -->
                            <ul v-for="(value, key) in this.timeline_data" :key="key">
                                <li key={{key}}>
                                    <h4>{{value.title}}</h4>
                                    <p>{{value.message}}</p>
                                    <button @click="handleTimelineDelete(value.id)">Delete entry</button>
                                    <button @click="handleDartsAdd(value.id)">{{value.darts}}</button>
                                </li>
                            </ul>
                        </div>

                        <form method="POST">
                            <div class="form-group row">
                                <label for="timeline_update.id" class="col-md-4 col-form-label text-md-right">Id of discussion to update</label>

                                <div class="col-md-6">
                                <input id="timeline_update.id" type="text" class="form-control" v-model="timeline_update.id" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeline_update.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="timeline_update.title" type="text" class="form-control" v-model="timeline_update.title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeline_update.message" class="col-md-4 col-form-label text-md-right">Message</label>

                                <div class="col-md-6">
                                <input id="timeline_update.message" type="text" class="form-control" v-model="timeline_update.message" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleTimelineUpdate">
                                    Update timeline item
                                </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import marked from 'marked'
    var debounce = require('lodash.debounce');
    export default {
        data() {
            return {
                idea_data: '',
                idea_id: '5678',
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
        mounted() {
            console.log('this.$route.params.id => ', this.$route.params.id);
            axios.post('/ai/idea/get/' + this.$route.params.id)
                .then(response => {
                    this.idea_data = response.data;
                    console.log('TCL: mounted -> this.idea_data', this.idea_data);
            });
        },
        methods: {
            handleDeleteIdea(e) {
                e.preventDefault();
                axios.post('/ai/idea/delete/' + this.$route.params.id)
                    .then(response => {
                        console.log('TCL: handleDeleteIdea -> response', response);
                });
            },

            // updates post functions
            handleUpdatePostDarts(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/update_post/darts/add/' + value,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                });
            },
            hanldeGetUpdateData(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/update_post/get/all/' + this.$route.params.id
                }).then( (response) => {
                    this.updates_post_data = response.data;
                }); 
            },
            handleUpdatePostSubmit(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/update_post/create/' + this.$route.params.id,
                    data: {
                        title: this.update_post.title,
                        message: this.update_post.message
                    }
                }).then( (response) => {
                    this.discussion_data = response.data;
                });
            },
            handleUpdatePostDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/update_post/delete/' + value,
                }).then( (response) => {
                    this.discussion_data = response.data;
                });
            },
            handleUpdatePostUpdate(e){
                e.preventDefault();
                let update_post_id = this.update_post_update.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/update_post/update/' + update_post_id,
                    data: {
                        title: this.update_post_update.title,
                        message: this.update_post_update.message,
                    },
                }).then( (response) => {
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },

            // discussion replies functions
            handleDiscussionReplyVote(reply_id, vote) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/reply/vote/' + reply_id + '/' + vote
                }).then( (response) => {
                    this.discussion_replies_data = response.data;
                });
            },
            handleDiscussionReplyiesDelete(value) {
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