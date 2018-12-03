<template>
  <v-card>
    <v-card-title>
      <div class="ca-title-4">Basic Information</div>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5">Email</div>
              <div class="ca-label-content">{{ student.email }}</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5">First Name</div>
              <div class="ca-label-content">{{ student.first_name }}</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5">Middle Name</div>
              <div class="ca-label-content">{{ student.middle_name }}</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5">Last Name</div>
              <div class="ca-label-content">{{ student.last_name }}</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5">Nickname</div>
              <div class="ca-label-content">{{ student.nickname }}</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5">Note</div>
              <div class="ca-label-content">{{ student.note }}</div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    student: {}
  }),
  created () {
    this.$axios.get(`/student/${this.$route.params.student_id}/basic_information`).then(res => {
      console.log('res1', res)
      this.student = res.data
    })
  }
}
</script>