<template>
  <section class="discussion-container fixed_width">
      <div class="sub_width">

        <div v-if="currentUser" class="new_discussion_box">
            <div class="profile-image-wrapper">
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

        <div v-if="showIdeaData && discussion_data && users_that_posted" id="discussion_data" class="all_discussion_posts">
            <div class="discussion_item" v-for="(value, key) in this.getDiscussion.discussions" :key="key">
                <router-link :to="'/user/' + getDiscussion.all_user[value.id][0].user_id" class="profile-image-wrapper">
                    <div class="profile-image" :style="{ 'background-image': `url(${getDiscussion.all_user[value.id][0].avatar})` }"></div>
                </router-link>
                <div class="discussion_data">
                    <h2 id="title" >{{value.title}}</h2>
                    <p id="message">{{value.message}}</p>
                </div>
                <div class="post_button" @click="handleDiscussionDelete(value.id)">
                    <p>Delete</p>
                </div>
                
            </div>
        </div>
    </div>
  </section>
</template>

<style lang="scss">
@import '~@/_variables.scss';
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
                showReply: false,
                showIdeaData: false,
                discussion_data: '',
                users_that_posted: {},
                showReplies: {},
                discussion_replies_data: {},
                reply_data: {},
                updates_post_data: '',
                currently_viewed_reply_id: 2120,
                discussion: {
                    title: '',
                    message: ''
                }
            }
        },
        computed: {
            getDiscussion() {
                return this.$ud_store.getters.getCurrentIdeaDiscussion
            },
            currentUser() {
                if (this.$ud_store.getters.getUserData === null) {
                    return null
                } else {
                    return this.$ud_store.getters.getUserData.id
                }
            },
            
        },
        update() {
            this.getUserReplyData();
        },
        watch: {
            getUserReplyData() {
                return this.users_that_posted
            }
        },
        mounted() {
            this.hanldeGetDiscussionData();
        },
        methods: {
            showReplyToggle(e) {
                e.preventDefault();
                this.showReply = true;
            },
            hanldeGetDiscussionData() {
                let idea_id = this.$route.params.id;
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/get/' + idea_id
                }).then( (res) => {
                    this.discussion_data = res.data;
                    this.$ud_store.commit('SET_IDEA_DISCUSSION', res.data);
                    this.showIdeaData = true;
                });   
            },
            handleDiscussionDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/discussion/delete/' + value,
                }).then( (response) => {
                    this.discussion_data = response.data;
                    this.hanldeGetDiscussionData();
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
                    this.hanldeGetDiscussionData();
                });
            },
            
        }
    }
</script>