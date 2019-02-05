<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Basic Information</div>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-2">
        <v-layout wrap>
          <v-flex xs6>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Type</div>
              <div class="ca-label-content" v-if="student.type">{{ student.type }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Status</div>
              <div class="ca-label-content" v-if="student.status">{{ student.status }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">First Name</div>
              <div class="ca-label-content" v-if="student.first_name">{{ student.first_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Middle Name</div>
              <div class="ca-label-content" v-if="student.middle_name">{{ student.middle_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Last Name</div>
              <div class="ca-label-content" v-if="student.last_name">{{ student.last_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Nickname</div>
              <div class="ca-label-content" v-if="student.nickname">{{ student.nickname }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Email</div>
              <div class="ca-label-content" v-if="student.email">{{ student.email }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Sex</div>
              <div class="ca-label-content" v-if="student.sex">{{ student.sex }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Date of Birth</div>
              <div class="ca-label-content" v-if="student.date_of_birth">{{ student.date_of_birth }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Country of Citizenship</div>
            <div class="ca-label-content" v-if="student.country_of_citizenship">{{ countries[student.country_of_citizenship] }}</div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Country of Birth</div>
            <div class="ca-label-content" v-if="student.country_of_birth">{{ countries[student.country_of_birth] }}</div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Cith of Birth</div>
            <div class="ca-label-content" v-if="student.city_of_birth">{{ student.city_of_birth }}</div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Note</div>
              <div class="ca-label-content" v-if="student.note">{{ student.note }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  computed: {
    student () {
      return this.$store.getters['student/student']
    },
    countries () {
      return this.$store.getters['student/countries']
    }
  }
}
</script>