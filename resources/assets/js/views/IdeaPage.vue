<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                  <div class="card-header">IdeaPage.vue</div>
                  <form method="GET">
                    <div class="form-group row">
                      <label for="idea_id" class="col-md-4 col-form-label text-md-right">find Idea by id (e.g. 5678)</label>

                      <div class="col-md-6">
                        <input id="idea_id" type="text" class="form-control" v-model="idea_id" required autofocus>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" @click="handleIdeaFinder">
                          Find my idea
                        </button>
                      </div>
                    </div>
                  </form>

                  <h1>{{this.ideaSingle}}</h1>

                  <h1>{{this.idea.title}}</h1>
                  <button @click="handldeGetSingleIdeaData">get single idea data</button><br/><br/>
                  <button @click="handleGetIdeaData">get all idea data</button><br/><br/>
                  <button @click="handleIdeaDelete">delete idea data (pre filled data)</button><br/><br/>
                  <button @click="handleIdeaUpdate">update idea data (with pre filled data to update with)</button><br/><br/>
                  <button @click="hanldeGetTimelineData">get timeline data from (pre filled) idea_id</button><br/><br/>
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
        ideaSingle: '',
        idea_id: '',
        errors: [],
        ideas: []
      }
    },
    mounted() {
      console.log('AddNewIdea.vue page');
    },
    methods: {
      hanldeGetTimelineData(e) {
        e.preventDefault();
        let idea_id = '5678';
        axios({
          method: 'GET',
          url: '/api/idea/timeline/' + idea_id + '/get',
        }).then( (response) => {
          console.log('​handleIdeaFinder -> response', response);
        });
      },
      handleIdeaUpdate(e) {
        e.preventDefault();
        let updateThis = '5678';
        axios({
          method: 'POST',
          url: '/api/idea/' + updateThis + '/update',
          data: {
              title: 'back 2 any ideas',
              pitch: 're-name pitch here'
          },
        }).then( (response) => {
          console.log('​handleIdeaFinder -> response', response);
        });
      },
      handleIdeaDelete(e) {
        e.preventDefault();
        let deleteThis = '1234';
        axios({
          method: 'POST',
          url: '/api/idea/' + deleteThis + '/delete',
        }).then( (response) => {
          console.log('​handleIdeaFinder -> response', response);
        });
      },
      handleIdeaFinder(e) {
        e.preventDefault();
        let goHere = this.idea_id;
        axios({
          method: 'GET',
          url: '/api/idea/' + goHere + '/get',
        }).then( (response) => {
          console.log('​handleIdeaFinder -> response', response);
          if (response.data === "") {
            alert('there is no idea with that ID');
          }
          this.ideaSingle = response.data.title;
        });
      },
      handldeGetSingleIdeaData(e) {
        let goHere = '5678';
        axios({
          method: 'GET',
          url: '/api/idea/' + goHere + '/get',
        }).then( (response) => {
          this.ideaSingleData = response.data
          console.log('​handleGetIdeaData -> this.ideaData', this.ideaSingleData);
        });

      },

      // on click gets ideas data and console logs them
      handleGetIdeaData(e) {
        e.preventDefault()
        axios.get('/api/idea/all/get').then( (response) => {
          this.ideaData = response.data
          console.log('​handleGetIdeaData -> this.ideaData', this.ideaData);
        })
      },
    }
  }
</script>