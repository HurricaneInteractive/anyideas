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
              console.log('TCL: search -> user get', response.data);
              this.user_data = response.data
            });
        },
        methods: {

        }

    }
</script>