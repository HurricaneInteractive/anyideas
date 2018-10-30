<template>
  <section class="user-ideas">
    <div class="idea_wrapper">
        <div v-if="user_ideas === ''"><loading/></div>
        <div v-else v-for="(value, key) in this.user_ideas" :key="key">
            <IdeaCard key={{key}} :props='value'/>
        </div>
    </div>
  </section>
</template>

<script>
import IdeaCard from '../IdeaCard.vue'
    export default {
      name: 'Ideas',
      components: {
        IdeaCard
      },
      data() {
        return {
          user_ideas: '',
        }
      },
      mounted() {
        console.log("User Ideas");
        this.getIdeaData();
      },
      methods: {
        getIdeaData() {
          this.user_ideas = this.$ud_store.state.current_user_ideas;
          console.warn('this.$ud_store.state.current_user_view ', this.$ud_store.state.current_user_view.user_meta)
          console.warn('this.$ud_store.state.current_user_ideas ', this.$ud_store.state.current_user_ideas)
        }
      }
    }
</script>