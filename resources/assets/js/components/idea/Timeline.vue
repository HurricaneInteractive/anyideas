<template>
  <section class="timeline">
    <h2>Timeline Goes Below</h2>

    <div>
      <h3>Timeline data</h3>
      <!-- <button @click="hanldeGetTimelineData">get timeline data from (pre filled) idea_id</button><br/><br/> -->
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
  </section>
</template>

<script>
    export default {
      // name: 'Timeline',
      data() {
          return {
            timeline: {
              title: '',
              message: ''
            },
            timeline_data: '',
            timeline_update: {
              title: '',
              message: '',
            },
          }
      },
      mounted() {
        console.log("%c Timeline.vue", this.$ud_store.state.consoleLog.component)
      },
      methods: {
        hanldeGetTimelineData() {
          axios({
              method: 'POST',
              url: '/ai/idea/timeline/get/' + this.$route.params.id,
          }).then( (response) => {
              this.timeline_data = response.data;
          });
        },
        handleTimelineSubmit(e){
          e.preventDefault();
          axios({
              method: 'POST',
              url: '/ai/idea/timeline/create/' + this.$route.params.id,
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
      }
    }
</script>