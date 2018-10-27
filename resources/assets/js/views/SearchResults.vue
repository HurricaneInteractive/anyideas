<template>
    <div class="container">
        <div class="row">
            <!-- <CategoryTitleCard :props="this.currentRoute" class="category-header"/> -->
            <h2>search term here</h2>
            <!-- map over search results - show 3 users max and then the rest ideas -->
            <!-- <div v-for="(value, key) in this.category_data" :key="key">
                <IdeaCard key={{key}} :props='value'/>
            </div> -->
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
        ideas: this.$parent.search_results.ideas,
        users: this.$parent.search_results.users
      }
    },
    mounted() {
      console.log('mounted searchResults')
      console.warn(this.$parent.search_results);
      console.warn(this.users);
      console.warn(this.ideas);
      // handle the above and use it
    },
    methods: {
      getIdeasByID(array_of_ids) {
        console.log('getIdeasByID(search_text)')
        if (this.search_text !== 'search' || this.search_text !== null) {
            console.log('search_text === defined')
            axios({
                method: 'POST',
                url: '/ai/get-by-ids/' + array_of_ids,
                data: this.search_text,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
                }
            })
            .then(res => {
                console.warn('​handleSubmit -> res', res);
                // could append results to the store? and then access the store on the SearchResults page
                // or figure out how to pass arrays between routes / functions

            })
          .catch(error => {
            console.error(error);
          });
        } else {
          console.log('maaaaate');
          return alert('make sure you fill in all the fields');
        }
      },
    }
  }
</script>