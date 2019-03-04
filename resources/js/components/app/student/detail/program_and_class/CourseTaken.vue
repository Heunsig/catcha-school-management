<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Courses Taken</div>
    </v-card-title>
    <v-card-text>
      <v-card>
        <v-card-text>
          <ul>
            <li v-for="course in courses_taken">
              {{ course.name }}
              {{ course.start_date }} ~ {{ course.completion_date }}
            </li>
          </ul>
        </v-card-text>
      </v-card>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  computed: {
    courses_taken () {
      return this.$store.getters['class/programs_taken']
    }
  }
}
</script>