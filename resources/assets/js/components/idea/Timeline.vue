<template>
  <section class="timeline fixed_width">
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
          <div class="form-group row">
              <label for="timeline.link" class="col-md-4 col-form-label text-md-right">Link</label>

              <div class="col-md-6">
              <input id="timeline.link" type="text" class="form-control" v-model="timeline.link" required>
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
          <ul v-for="(value, key) in this.currentTimelineData" :key="key">
              <li key={{key}}>
                  <h4>{{value.title}}</h4>
                  <p>{{value.message}}</p>
                  <a :href="value.link" target="_blank">Link</a>
                  <button @click="handleTimelineDelete(value.id)">Delete entry</button>
                  <button @click="handleTimelineDartsAdd(value.id)">{{value.darts}}</button>
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
          <div class="form-group row">
              <label for="timeline_update.link" class="col-md-4 col-form-label text-md-right">Link</label>

              <div class="col-md-6">
              <input id="timeline_update.link" type="text" class="form-control" v-model="timeline_update.link" required>
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

<style lang="scss">
@import '~@/_variables.scss';


</style>

<script>
    export default {
      // name: 'Timeline',
      data() {
          return {
            timeline: {
              title: '',
              message: '',
              link: ''
            },
            timeline_data: '',
            timeline_update: {
              title: '',
              message: '',
              link: ''
            },
          }
      },
      computed: {
          currentTimelineData() {
              return this.$ud_store.getters.getCurrentIdeaTimeline
          }
      },
      mounted() {
        console.log("%c Timeline.vue", this.$ud_store.state.consoleLog.component)
        this.hanldeGetTimelineData();
        console.warn('currentTimelineData => ', this.currentTimelineData)
        console.warn('currentTimelineData => ', this.currentTimelineData[0])
        console.warn('currentTimelineData => ', this.currentTimelineData[0].title)
        console.warn('currentTimelineData => ', this.currentTimelineData)
      },
      methods: {
            hanldeGetTimelineData() {
                console.log('run hanldeGetTimelineData()')
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/get/' + this.$route.params.id,
                }).then( (res) => {
                    console.log('TCL: hanldeGetTimelineData -> res', res);
                    // push to store getter
                    this.$ud_store.commit('SET_IDEA_TIMELINE', res.data );
                    this.timeline_data = res.data;
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
                        link: this.timeline.link
                    },
                }).then( (res) => {
                    console.log('TCL: hanldeGetTimelineData -> res', res.data);
                    this.hanldeGetTimelineData()
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
                        lnik: this.timeline_update.link
                    },
                }).then( (res) => {
                    console.log('TCL: hanldeGetTimelineData -> res', res);
                    this.hanldeGetTimelineData()
                });
            },
            handleTimelineDelete(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/delete/' + value,
                }).then( (res) => {
                    console.log('delete => ', res)
                    this.hanldeGetTimelineData()
                });
            },
            handleTimelineDartsAdd(value) {
                axios({
                    method: 'POST',
                    url: '/ai/idea/timeline/darts/add/' + value,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                    }
                }).then(res => {
                    console.log('dartsAdd => ', res)
                    this.hanldeGetTimelineData()
                });
            },
        }
    }
</script>