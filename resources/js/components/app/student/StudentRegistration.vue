<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">Student Registration</h1>
              <v-breadcrumbs :items="breadcrumbs" class="ca-breadcrumbs">
                <template slot="item" slot-scope="props">
                  <span v-if="props.item.disabled" :class="[props.item.disabled && 'ca-disabled']">{{ props.item.text }}</span>
                  <a v-else @click="">{{ props.item.text }}</a>
                </template>
              </v-breadcrumbs>
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