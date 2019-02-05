<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <BasicInformation></BasicInformation>
      </v-flex>
      <v-flex xs5 class="pr-2">
        <Contact></Contact>
      </v-flex>
      <v-flex xs7 class="pl-2">
        <EmergencyContact></EmergencyContact>
      </v-flex>
      <v-flex x12>
        <Address></Address>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import BasicInformation from './BasicInformation'
import Contact from './Contact'
import EmergencyContact from './emergency_contact/Index'
import Address from './address/Index'

export default {
  components: {
    BasicInformation,
    Contact,
    EmergencyContact,
    Address
  }
}
</script>