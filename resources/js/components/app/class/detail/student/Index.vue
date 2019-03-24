<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            <h4 class="ca-title-typo-4">Students</h4>
          </v-card-title>
          <v-card-text>
            <ul>
              <li v-for="student in students">
                {{ student.full_name }}
              </li>
            </ul>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  computed: {
    students () {
      return this.$store.getters['class/classinfo'].students
    }
  }
}
</script>