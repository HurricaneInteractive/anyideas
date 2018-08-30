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
                    </div>

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
                                    <p>{{value.message}}</p>
                                    <button @click="handleDiscussionDelete(value.id)">Delete entry</button>
                                    <button>display no of replies</button>
                                </li>
                            </ul>
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
                                <label for="timeline_update.id" class="col-md-4 col-form-label text-md-right">Timeline item to update (ID)</label>

                                <div class="col-md-6">
                                <input id="timeline_update.id" type="text" class="form-control" v-model="timeline_update.id" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeline_update.title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                <input id="timeline_update.title" type="text" class="form-control" v-model="timeline_update.title" required autofocus>
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
                    id: '',
                    title: '',
                    message: '',
                },
                discussion_update: {
                    id: '',
                    title: '',
                    message: '',
                },
                timeline_data: '',
                discussion_data: '',
                errors: [],
                ideas: []
            }
        },
        mounted() {
            console.log('home.vue page');
            console.log('this.$route.params.id => ', this.$route.params.id);
            axios.post('/ai/idea/get/' + this.$route.params.id)
                .then(response => {
                    console.log('got ideas', response.data);
                    this.idea_data = response.data;
            });
        },
        methods: {
            handleDiscussionDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/delete/' + value,
                }).then( (response) => {
                    console.log('getDiscussionData -> response', response);
                    this.discussion_data = response.data;
                });
            },
            handleDiscussionUpdate(e){
                e.preventDefault();
                let discussion_id = this.discussion_update.id;
                console.log('​handleTimelineUpdate -> discussion_update', this.discussion_update);
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/update/' + discussion_id,
                    data: {
                        title: this.discussion_update.title,
                        message: this.discussion_update.message,
                    },
                }).then( (response) => {
                    console.log('handleTimelineSubmit -> response', response);
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },
            handleDiscussionSubmit(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/get/' + this.$route.params.id,
                }).then( (response) => {
                    console.log('getTimelineData -> response', response);
                    this.discussion_data = response.data;
                });
            },
            hanldeGetDiscussionData(e) {
                e.preventDefault();
                let idea_id = this.$route.params.id;
                console.log('TCL: hanldeGetDiscussionData -> idea_id ', idea_id );
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/get/' + idea_id
                }).then( (response) => {
                    console.log('handleTimelineSubmit -> response', response);
                    this.discussion_data = response.data;
                });   
            },
            handleTimelineUpdate(e){
                e.preventDefault();
                let idea_id = this.timeline_update.id;
                console.log('​handleTimelineUpdate -> timeline_update', this.timeline_update);
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/update/' + idea_id,
                    data: {
                        title: this.timeline_update.title,
                        message: this.timeline_update.message,
                    },
                }).then( (response) => {
                    console.log('handleTimelineSubmit -> response', response);
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
                }).then( (response) => {
                    console.log('handleDartsAdd -> response.data', response.data);
                });
            },
            handleTimelineDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/delete/' + value,
                }).then( (response) => {
                    console.log('getTimelineData -> response', response);
                    this.timeline_data = response.data;
                });
            },
            getTimelineData(e) {
                e.preventDefault();
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/get/' + this.$route.params.id,
                }).then( (response) => {
                    console.log('getTimelineData -> response', response);
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
                    console.log('hanldeGetTimelineData -> response', response);
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
                    console.log('handleTimelineSubmit -> response', response);
                    if (response.data === "") {
                        alert('error creating timeline entry');
                    }
                });
            },
        }

    }
</script>