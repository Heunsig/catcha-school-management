<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <StudentList></StudentList>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import StudentList from './student/Index'

export default {
  components: {
    StudentList
  }
}
</script>