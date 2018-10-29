<template>
    <div class="container">
        <div class="row">
            <div>
                <header>
                    <img :src="this.user_data.avatar" :alt="this.user_data.avatar"/>
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
                        Facebook: {{user_data.social_media.facebook}}
                        </li>
                        <li>
                        Instagram: {{user_data.social_media.instagram}}
                        </li>
                        <li>
                        YouTube: {{user_data.social_media.youtube}}
                        </li>
                    </ul>
                </header>

                <!-- <div v-if="this.$ud_store.state.data.user_data.id === this.user_data.user.id"> -->
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

                <TabNav v-bind:props="tab_nav"/>

                <div>
                    <h2>users ideas</h2>
                    <div class="idea_wrapper">
                        <div v-for="(value, key) in this.user_ideas" :key="key">
                            <IdeaCard key={{key}} :props='value'/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import IdeaCard from '../components/IdeaCard'
    import TabNav from '../components/TabNav'
    export default {
        components: {
            IdeaCard, TabNav
        },
        data() {
            return {
                idea: {
                    title: '',
                    description: ''
                },
                user_meta_update: {
                    name: '',
                    avatar: '',
                    username: '',
                    email: '',
                    interests: '',
                    social_media: '',
                    website: '',
                    occupation: '',
                },
                user_ideas: '',
                user_data: '',
                tab_nav: [
                    {
                        id: 'ideas',
                        label: 'Users Ideas',
                        route: '/ideas',
                        active: this.$route.name === 'ideas' ? true : false
                    },
                    {
                        id: 'about',
                        label: 'About',
                        route: '',
                        active: this.$route.name === 'about' ? true : false,
                    }
                ],
            }
        },
        // figure out passing MySQL data to Vue
        beforeMount() {
            console.log('this.$ud_store.state.data.user_data => ', this.$ud_store.state.data.user_data);
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
        mounted() {
            
        },
        methods: {
            setAsActive() {
                this.tab_nav = [
                    {
                        id: 'ideas',
                        label: 'User Ideas',
                        route: '/ideas',
                        active: this.$route.name === 'ideas' ? true : false
                    },
                    {
                        id: 'about',
                        label: 'About',
                        route: '',
                        active: this.$route.name === 'about' ? true : false,
                    }
                ];
            },
            handleUpdateUserMeta() {
                axios({
                    method: 'POST',
                    url: '/ai/user/update/' + this.$route.params.id,
                    data: {
                        name: this.user_meta_update.name,
                        avatar: this.user_meta_update.avatar,
                        username: this.user_meta_update.username,
                        email: this.user_meta_update.email,
                        interests: this.user_meta_update.interests,
                        social_media: this.user_meta_update.social_media,
                        website: this.user_meta_update.website,
                        occupation: this.user_meta_update.occupation,
                    }
                }).then( (response) => {
                    this.user_ideas = response.data
                    console.warn('TCL: handleUpdateUserMeta -> this.user_ideas', this.user_ideas);
                });
            }
        }

    }
</script>

<!--
    https://api.netlify.com/build_hooks/5b8f4d8073f2cf07b2c54431 
-->