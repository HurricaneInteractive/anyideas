<template>
  <section class="updates">
    <h2>Discussion Posts Go Below</h2>
    <section>
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
                        <button @click="handleDiscussionReplyDelete(value.id)">Delete entry</button>
                        <button @click="handleDiscussionReplyVote(value.id)">{{value.darts}} | Darts</button>
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
    </section>
  </section>
</template>

<script>
    export default {
      name: 'Updates',
      data() {
          return {
            discussion_data: '',
            updates_post_data: '',
            discussion: {
              title: '',
              message: ''
            },
            discussion_update: {
              id: '',
              title: '',
              message: '',
            },
            update_post_update: {
              id: '',
              title: '',
              message: ''
            },
          }
      },
      mounted() {
        console.log('Updates.vue')
        this.hanldeGetDiscussionData();
      },
      methods: {
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
        hanldeGetDiscussionData() {
            let idea_id = this.$route.params.id;
            axios({
                method: 'POST',
                url: '/ai/idea/discussion/get/' + idea_id
            }).then( (response) => {
                this.discussion_data = response.data;
            });   
        },
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
      }
    }
</script>