<template>
  <section class="discussion-container fixed_width">
      <div class="sub_width">

        <div class="new_discussion_box">
            <div class="profile-image-wrapper">
                <div class="profile-image" :style="{ 'background-image': `url(https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTQ3NTI2NTg2OTE1MTA0MjM4/kenrick_lamar_photo_by_jason_merritt_getty_images_entertainment_getty_476933160.jpg)` }"></div>
            </div>
            <div class="input_discussion_container">
                <label for="discussion.title">Title</label>
                <input id="title" placeholder="Title" type="text" class="form-control" v-model="discussion.title" required autofocus/>
                <label for="discussion.message">Message</label>
                <textarea id="message" placeholder="Constructive feedback goes here" type="text" class="form-control" v-model="discussion.message" required/>
            </div>
            <div class="post_button" @click="handleDiscussionSubmit">
                <p>Post</p>
            </div>
        </div>


                    <!-- <h1>{{getReplies[2120].replies.length}}</h1> -->
                    <!-- <h1>{{getReplies[2121].replies}}</h1> -->
                    <h1>{{getReplies[2120]}}</h1>
                    <hr/>
                    <h1>{{getReplies[2121]}}</h1>
                    <hr/>
                    <h1>{{getReplies}}</h1>

        <div id="discussion_data" class="all_discussion_posts">
            <!-- @{{ discussion_data }} -->
            <div class="discussion_item" v-for="(value, key) in this.discussion_data" :key="key">
                <div class="profile-image-wrapper">
                    <!-- pull in users profile image  -->
                    <!-- <h6>{{value.id}}</h6> -->
                    <div class="profile-image" :style="{ 'background-image': `url(https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTQ3NTI2NTg2OTE1MTA0MjM4/kenrick_lamar_photo_by_jason_merritt_getty_images_entertainment_getty_476933160.jpg)` }"></div>
                </div>
                <div class="discussion_data">
                    <h2 id="title" >{{value.title}}</h2>
                    <p id="message">{{value.message}}</p>
                </div>
                <div class="post_button" @click="handleDiscussionDelete(value.id)">
                    <p>Delete</p>
                </div>
                <!-- make replies number dynamic -->
                <div class="post_button" @click="openReplies(value.id)">
                    <!-- <p>{{
                        getReplies[value.id] === undefined
                            ? getReplies[value.id].replies === null
                                ? 0
                                : getReplies[value.id].replies.length
                        : 0
                    }} replies</p> -->
                </div>

                <!-- <section v-if="typeof getReplies[value.id].show === undefined" class="discussion_replies" v-bind:style="{ paddingLeft: '48px'}"> -->
                    <p>ideas will go here</p>
                    <!-- <ul v-if="getReplies[value.id].replies !== null">
                        <li v-for="(reply_val, key) in this.getReplies[value.id].replies" :key="key">
                            <h4>{{reply_val.title}}</h4>
                            <h6>{{reply_val.id}}</h6>
                            <p>{{reply_val.message}}</p>
                            <button @click="handleDiscussionReplyDelete(reply_val.id)">Delete entry</button>
                            <button @click="handleDiscussionReplyVote(reply_val.id)">{{reply_val.darts}} | Darts</button>
                        </li>
                    </ul>
                    <p v-else>no replies</p> -->
                <!-- </section> -->
                <section>
                    <p>hide replies</p>
                </section>
            </div>
            
        </div>

        <!-- <h4>update discussion item</h4>
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
                <button type="submit" class="btn btn-primary" @click="handleDiscussionUpdate">
                    Update discussion_update item
                </button>
                </div>
            </div>
        </form> -->
        
    </div>
  </section>
</template>

<style lang="scss">
@import '~@/_variables.scss';

/* .discussion-container {

} */
.new_discussion_box {
    position: relative;
    display: grid;
    grid-template-columns: 20% 1fr;
    margin-bottom: 48px;
    label {
        display: none;
    }
    input, textarea {
        border: none;
        background-color: transparent;
        padding-bottom: 2px;
        border-bottom: 1px solid transparent;
        transition: .25s;
        outline: none;
        &:focus {
            border: none;
            outline: none;
            border-bottom: 1px solid $black;
            transition: .5s;
        }
    }
    .post_button {
        position: absolute;
        right: 0px;
        bottom: 0px;
        justify-self: flex-end;
        padding: 5px 15px;
        background: white;
        border-radius: 200px;
        line-height: 1;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 3px 6px 0 rgba($black, 0.16);
        p {
            margin: 0 auto;
            padding: 4px 0;
            flex-grow: 2;
            font-size: .9rem;
            font-weight: $w-bold;
        }
        span {
            width: 22px;
            span svg {
                display: block;
            }
        }
    }
    .profile-image-wrapper {
        position: relative;
        .profile-image {
            width: 68px;
            height: 68px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            border-radius: 50%;
        }
    }
    .input_discussion_container {
        width: 100%;
        display: grid;
        margin-bottom: 48px;
        padding: 16px 28px;
        box-shadow: 0 3px 6px 0 rgba($black, 0.16);
        #title {
            width: auto;
            position: relative;
            color: $black;
            margin: 0 0 8px;
            font-size: 1.5rem;
            font-weight: $w-bold;
            input {
                color: $black;
                font-size: 1.5rem;
                font-weight: $w-bold;
            }
        }
        #message {
            color: $grey-dark;
            font-size: 1rem;
            min-height: 124px;
        }
    }
    
    
}
.all_discussion_posts {
    position: relative;
    display: grid;
    grid-template-columns: 1fr;
    margin: 36px 0;
    .discussion_item {
        position: relative;
        display: grid;
        grid-template-columns: 20% 1fr;
        margin: 24px 0;
        .post_button {
            position: absolute;
            right: 0px;
            bottom: 0px;
            justify-self: flex-end;
            padding: 5px 15px;
            background: white;
            border-radius: 200px;
            line-height: 1;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 3px 6px 0 rgba($black, 0.16);
            p {
                margin: 0 auto;
                padding: 4px 0;
                flex-grow: 2;
                font-size: .9rem;
                font-weight: $w-bold;
            }
            span {
                width: 22px;
                span svg {
                    display: block;
                }
            }
        }
        .profile-image-wrapper {
            position: relative;
            .profile-image {
                width: 68px;
                height: 68px;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                border-radius: 50%;
            }
        }
        .discussion_data {
            width: 100%;
            display: grid;
            margin: 0 0 64px;
            #title {
                width: auto;
                position: relative;
                color: $black;
                margin: 0 0 8px;
                font-size: 1.5rem;
                font-weight: $w-bold;
                input {
                    color: $black;
                    font-size: 1.5rem;
                    font-weight: $w-bold;
                }
            }
            #message {
                color: $grey-dark;
                font-size: 1rem;
                /* min-height: 124px; */
            }
        }
    }
    
}

</style>

<script>
    export default {
      name: 'Updates',
      data() {
          return {
            discussion_data: '',
            showReplies: {},
            discussion_replies_data: {},
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
            }
          }
      },
      computed: {
        getIdeaUserId() {
          return this.$ud_store.getters.getCurrentIdeaUserId
        },
        currentUserData() {
          return this.$ud_store.getters.getUserData
        },
        currentUserMeta() {
            return this.$ud_store.getters.getUserMeta
        },
        getReplies() {
            return this.$ud_store.getters.getCurrentIdeaDiscussionReplies
        }
      },
      mounted() {
        console.log("%c Discussion.vue", this.$ud_store.state.consoleLog.component)
        this.hanldeGetDiscussionData();
        console.warn('this.$ud_store.getters.getUserMeta => ', this.$ud_store.getters.getUserMeta)
        console.warn('this.currentUserMeta => ', this.currentUserMeta)
      },
      methods: {
        openReplies(value) {
            this.showReplies[value] = true;
        },
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
            }).then( (res) => {
                if (res.data === "") {
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
            }).then( (res) => {
                this.discussion_data = res.data;
            });
        },
        hanldeGetDiscussionData() {
            let idea_id = this.$route.params.id;
            axios({
                method: 'POST',
                url: '/ai/idea/discussion/get/' + idea_id
            }).then( (res) => {
                console.log('hanldeGetDiscussionData(res) => ', res)
                this.discussion_data = res.data;
                for (let i = 0; i < res.data.length; i++) {
                    this.handleDiscussionRepliesGet(res.data[i].id);
                }
                
            });   
        },
        // discussion replies functions
        handleDiscussionReplyVote(reply_id) {
            axios({
                method: 'POST',
                url: '/ai/idea/discussion/reply/darts/' + reply_id
            }).then( (res) => {
                this.discussion_replies_data = res.data;
            });
        },
        handleDiscussionReplyDelete(value) {
            axios({
                method: 'POST',
                url: '/ai/idea/discussion/reply/delete/' + value,
            }).then( (res) => {
                this.discussion_replies_data = res.data;
            });
        },
        handleDiscussionRepliesGet(value) {
            axios({
                method: 'POST',
                url: '/ai/idea/discussion/reply/get/all/' + value
            }).then( (res) => {
                console.log('res.data => ', res.data)
                let newItem = {
                    "replies": null,
                    "show": false
                }
                if (res.data.length !== 0) {
                    newItem = {
                        "replies": res.data,
                        "show": false
                    }
                }
                console.log('newItem => ', newItem)

                this.discussion_replies_data[value] = newItem;
                // push to store + getter
                this.$ud_store.commit('SET_IDEA_DISCUSSION_REPLIES', this.discussion_replies_data);                
                console.log('this.discussion_replies_data => ', this.discussion_replies_data)
            }); 
        },
      }
    }
</script>