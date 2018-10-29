<template>
    <div class="container">
        <div class="row">

            <!-- <header>
              <h2>search term here</h2>
            </header> -->

            <div v-if="this.users.length !== 0" class="users_results fixed_width">
              <h2>Users</h2>
              <div v-for="(value, key) in this.users" :key="key">
                <!-- add UserCard component and use here -->
                <p>user</p>
                <h4>{{users[key].name}}</h4>
                <h4>{{users[key].id}}</h4>
              </div>
            </div>

            <div v-else class="users_results fixed_width">
              <h2>Users</h2>
              <div class="no_results">
                <p>no users found</p>
              </div>
            </div>

            <div v-if="this.ideas.length !== 0 " class="ideas_results fixed_width">
              <h2>Ideas</h2>
              <div v-for="(value, key) in this.ideas" :key="key">
                <IdeaCard key={{key}} :props='value'/>
              </div>
            </div>

            <div v-else class="ideas_results fixed_width">
              <h2>Ideas</h2>
              <div class="no_results">
                <p>no ideas found</p>
              </div>
            </div>
            
        </div>
    </div>
</template>

<style lang="scss">
@import '~@/App.scss';

</style>

<script>
import IdeaCard from '../components/IdeaCard'
  export default {
    name: 'SearchResults',
    components: {
      IdeaCard
    },
    data() {
      return {
        currentRoute: this.$route.params.id,
        ideas: [],
        users: []
      }
    },
    mounted() {
      console.log('mounted searchResults')
      
      console.warn('TCL: mounted -> this.$ud_store.state', this.$ud_store.state);
      console.warn('TCL: mounted -> this.$ud_store.state.current_search', this.$ud_store.state.current_search);
      this.ideas = this.$ud_store.state.current_search.ideasQuery.slice(1,3);
      this.users = this.$ud_store.state.current_search.usersQuery;
      console.log('this.users => ', this.users);
      console.log('this.ideas => ', this.ideas);
      console.log('this.ideas.length => ', this.ideas.length)
      console.log('this.users.length => ', this.users.length)
    },
    methods: {
      
    }
  }
</script>