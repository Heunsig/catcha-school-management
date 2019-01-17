<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Basic Information</div>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Email</div>
              <div class="ca-label-content" v-if="basic_information.email">{{ basic_information.email }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">First Name</div>
              <div class="ca-label-content" v-if="basic_information.first_name">{{ basic_information.first_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Middle Name</div>
              <div class="ca-label-content" v-if="basic_information.middle_name">{{ basic_information.middle_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Last Name</div>
              <div class="ca-label-content" v-if="basic_information.last_name">{{ basic_information.last_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Nickname</div>
              <div class="ca-label-content" v-if="basic_information.nickname">{{ basic_information.nickname }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Note</div>
              <div class="ca-label-content" v-if="basic_information.note">{{ basic_information.note }}</div>
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
    basic_information () {
      return this.$store.getters['student/basic_information']
    }
  }
}
</script>