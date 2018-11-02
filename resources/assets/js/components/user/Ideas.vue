<template>
  <section class="user-ideas">
    <div class="idea_wrapper">

        <template v-if="!userIdeas">
          <h1>No Ideas</h1>
        </template>

        <template v-else>
          <IdeaCard v-for="(value, key) in userIdeas" :key="key" :props='value'/>
        </template>

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
    computed: {
      userIdeas() {
        return this.$ud_store.getters.getUserIdeas
      }
    }
  }
</script>