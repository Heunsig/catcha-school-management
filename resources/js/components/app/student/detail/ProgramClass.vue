<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <Class></Class>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
// import CourseTakenSection from './program_and_class/CourseTaken'
import Class from './program_and_class/Class'

export default {
  components: {
    // CourseTakenSection,
    Class
  },
  created () {
  }
}
</script>