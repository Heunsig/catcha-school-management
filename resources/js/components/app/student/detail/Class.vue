<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <CourseTakenSection></CourseTakenSection>
      </v-flex>
      <v-flex xs12>
        <ClassSection></ClassSection>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import CourseTakenSection from './particles/class/CourseTaken'
import ClassSection from './particles/class/Class'
export default {
  components: {
    CourseTakenSection,
    ClassSection
  },
  data: () => ({
    // class_groups: [],
    // classes: []
  }),
  created () {
    this.$store.dispatch('class/get_class_page', this.$route.params.student_id)
  }
}
</script>