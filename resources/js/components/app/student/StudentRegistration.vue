<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">Student Registration</h1>
              <CaBreadcrumbs :items="breadcrumbs"></CaBreadcrumbs>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs12>
        <registration-form></registration-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import RegistrationForm from './StudentRegistraionForm'
export default {
  components: {
    RegistrationForm
  },
  data: () => ({
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false
      },
      {
        text: 'Student',
        disabled: false
      },
      {
        text: 'Registration',
        disabled: true
      }
    ]
  }),
}
</script>