<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">AddNewIdea.vue</div>
                    <button @click="handleGetIdeaData">get all idea data</button>

                    <div class="card-body">
                        <form method="POST" action="{route('idea-add-new') }">
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input value="Idea no.42" id="title" type="text" class="form-control" v-model="idea.title" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pitch" class="col-md-4 col-form-label text-md-right">Pitch</label>

                                <div class="col-md-6">
                                    <input value="MySQL seemed like a good idea at the time" id="pitch" type="text" class="form-control" v-model="idea.pitch" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                                <div class="col-md-6">
                                    <input value="pre-alpha 0.0.0.1" id="status" type="text" class="form-control" v-model="idea.status" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description.md</label>

                                <div class="col-md-6">
                                    <input value="idea description goes here" id="description" type="text" class="form-control" v-model="idea.description" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image (url to ->)</label>

                                <div class="col-md-6">
                                    <input value="image to match idea" id="image" type="text" class="form-control" v-model="idea.image" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Confirm Idea
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
    export default {
        data() {
            return {
                idea: {
                    title: '',
                    description: '',
                    pitch: '',
                    status: '',
                    image: '',
                },
                errors: [],
                ideas: []
            }
        },
        mounted() {
            console.log('AddNewIdea.vue page');
        },
        methods: {
            // on click gets titles of all ideas and console logs them
            
            handleGetIdeaData() {
                axios.get('/api/idea-get-all').then( (response) => {
                    this.ideaData = response.data
                    console.log('​handleGetIdeaData -> this.ideaData', this.ideaData);
                })
            },
            handleSubmit(e) {
                e.preventDefault()

                if (this.title !== '' && this.description !== null && this.pitch !== null && this.status !== null && this.image !== null) {
                    axios({
                        method: 'POST',
                        data: {
                            title: this.idea.title,
                            description: this.idea.description,
                            pitch: this.idea.pitch,
                            status: this.idea.status,
                            image: this.idea.image
                        },
                        url: '/api/idea/create'
                    })
                    .then(response => {
                        console.log('​handleSubmit -> response', response);
                        if (response.status === 200) {
                            window.location = '/';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
                } else {
                    console.log('maaaaate');
                    return alert('make sure you fill in all the fields');
                }
            }
        }

    }
</script>