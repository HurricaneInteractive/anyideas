<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default"  v-bind:style="{ width: '750px', margin: '0 auto' }">
                    <div class="card-header">Home.vue View</div>

                    <div class="card-body">
                        <h1>{{user_data.user.name}}</h1>
                        <h2>@{{user_data.user.username}}</h2>
                        <h5>Interests</h5>
                        <ul v-for="(value, key) in this.user_data.interests" :key="key">
                          <li key={{key}}>
                            {{value}}
                          </li>
                        </ul>
                        <ul>
                          <li>
                            Facebook: {{this.user_data.social_media.facebook}}
                          </li>
                          <li>
                            Instagram: {{this.user_data.social_media.instagram}}
                          </li>
                          <li>
                            YouTube: {{this.user_data.social_media.youtube}}
                          </li>
                        </ul>
                    </div>

                    <div>
                        <h1>Edit user meta</h1>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="update_post.name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.name" type="text" class="form-control" v-model="user_meta_update.name" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.username" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.username" type="text" class="form-control" v-model="user_meta_update.username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.email" type="text" class="form-control" v-model="user_meta_update.email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.interests" class="col-md-4 col-form-label text-md-right">Interests</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.interests" type="text" class="form-control" v-model="user_meta_update.interests">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.social_media" class="col-md-4 col-form-label text-md-right">Social Medias</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.social_media" type="text" class="form-control" v-model="user_meta_update.social_media">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.website" class="col-md-4 col-form-label text-md-right">Website</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.website" type="text" class="form-control" v-model="user_meta_update.website">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_meta_update.occupation" class="col-md-4 col-form-label text-md-right">Occupation</label>

                                <div class="col-md-6">
                                <input id="user_meta_update.occupation" type="text" class="form-control" v-model="user_meta_update.occupation">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="handleUpdateUserMeta">
                                    Post user_meta_update update
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div>
                        <h2>users ideas</h2>
                        <div>
                            <div v-for="(value, key) in this.user_ideas" :key="key">
                                <div key={{key}}>
                                    <h4>{{value.title}}</h4>
                                    <p>{{value.pitch}}</p>
                                    <router-link :to="`/idea/${value.id}`">go to idea {{value.id}}</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                idea: {
                    title: '',
                    description: ''
                },
                user_meta_update: {
                    name: '',
                    username: '',
                    email: '',
                    interests: '',
                    social_media: '',
                    website: '',
                    occupation: '',
                },
                user_ideas: '',
                user_data: '',
                errors: [],
                ideas: []
            }
        },
        // figure out passing MySQL data to Vue
        mounted() {
            axios({
              method: 'POST',
              url: '/ai/idea/get-by-user/' + this.$route.params.id,
            }).then( (response) => {
              this.user_ideas = response.data
            });
            axios({
              method: 'POST',
              url: '/ai/user/get/' + this.$route.params.id,
            }).then( (response) => {
            //   console.log('TCL: search -> user get', response.data);
              this.user_data = response.data
            });
        },
        methods: {
            handleUpdateUserMeta() {
                axios({
                    method: 'POST',
                    url: '/ai/user/update/' + this.$route.params.id,
                    data: {
                        name: this.user_meta_update.name,
                        username: this.user_meta_update.username,
                        email: this.user_meta_update.email,
                        interests: this.user_meta_update.interests,
                        social_media: this.user_meta_update.social_media,
                        website: this.user_meta_update.website,
                        occupation: this.user_meta_update.occupation,
                    }
                }).then( (response) => {
                    this.user_ideas = response.data
                });
            }
        }

    }
</script>