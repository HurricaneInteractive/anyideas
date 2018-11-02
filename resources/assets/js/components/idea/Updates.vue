<template>
  <section class="updates fixed_width">
    <h2>Updates Goes Below</h2>
    <h1>Idea ID = {{this.$route.params.id}}</h1>

    <section>
      <div>
        <h3>Updates data</h3>
        <!-- <button @click="hanldeGetUpdateData">get update_posts data from (pre filled) idea_id</button><br/><br/>    -->
    
        <form method="POST">
            <div class="form-group row">
                <label for="update_post.title" class="col-md-4 col-form-label text-md-right">Title</label>

                <div class="col-md-6">
                <input id="update_post.title" type="text" class="form-control" v-model="update_post.title" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="update_post.message" class="col-md-4 col-form-label text-md-right">Message</label>

                <div class="col-md-6">
                <input id="update_post.message" type="text" class="form-control" v-model="update_post.message" required>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" @click="handleUpdatePostSubmit">
                    Post update_post update
                </button>
                </div>
            </div>
        </form>

        <div id="updates_post_data">
            <!-- @{{ updates_post_data }} -->
            <ul v-for="(value, key) in this.updates_post_data" :key="key">
                <li key={{key}}>
                    <h4>{{value.title}}</h4>
                    <p>{{value.message}}</p>
                    <button @click="handleUpdatePostDelete(value.id)">Delete entry</button>
                    <button @click="handleUpdatePostDarts(value.id)">{{value.darts}}</button>
                </li>
            </ul>
        </div>

        <h4>update_post item</h4>
        <form method="POST">
            <div class="form-group row">
                <label for="update_post_update.id" class="col-md-4 col-form-label text-md-right">update_post id to update</label>

                <div class="col-md-6">
                <input id="update_post_update.id" type="text" class="form-control" v-model="update_post_update.id" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="update_post_update.title" class="col-md-4 col-form-label text-md-right">Title</label>

                <div class="col-md-6">
                <input id="update_post_update.title" type="text" class="form-control" v-model="update_post_update.title" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="update_post_update.message" class="col-md-4 col-form-label text-md-right">Message</label>

                <div class="col-md-6">
                <input id="update_post_update.message" type="text" class="form-control" v-model="update_post_update.message" required>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" @click="handleUpdatePostUpdate">
                    Update updates_item
                </button>
                </div>
            </div>
        </form>
    </div>
    </section>
  </section>
</template>

<style lang="scss">
@import '~@/_variables.scss';


</style>

<script>
    export default {
      name: 'Updates',
      data() {
          return {
            updates_post_data: '',
            update_post: {
              title: '',
              message: ''
            },
            update_post_create: {
              id: '',
              title: '',
              message: ''
            },
            update_post_update: {
              id: '',
              title: '',
              message: ''
            },
          }
      },
      mounted() {
        console.log("%c Updates.vue", this.$ud_store.state.consoleLog.component)
      },
      methods: {
        // updates post functions
        handleUpdatePostDarts(value) {
            axios({
                method: 'POST',
                url: '/ai/idea/update_post/darts/add/' + value,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                }
            });
        },
        hanldeGetUpdateData(e) {
            e.preventDefault();
            axios({
                method: 'POST',
                url: '/ai/idea/update_post/get/all/' + this.$route.params.id
            }).then( (response) => {
                this.updates_post_data = response.data;
            }); 
        },
        handleUpdatePostSubmit(e) {
            e.preventDefault();
            axios({
                method: 'POST',
                url: '/ai/idea/update_post/create/' + this.$route.params.id,
                data: {
                    title: this.update_post.title,
                    message: this.update_post.message
                }
            }).then( (response) => {
                this.update_post_create = response.data;
            });
        },
        handleUpdatePostDelete(value) {
            axios({
                method: 'POST',
                url: '/ai/idea/update_post/delete/' + value,
            }).then( (response) => {
                this.update_post_create = response.data;
            });
        },
        handleUpdatePostUpdate(e){
            e.preventDefault();
            let update_post_id = this.update_post_update.id;
            axios({
                method: 'POST',
                url: '/ai/idea/update_post/update/' + update_post_id,
                data: {
                    title: this.update_post_update.title,
                    message: this.update_post_update.message,
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