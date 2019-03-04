<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-3">Address</div>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-3-y">
        <v-layout wrap>
          <v-flex xs12>
            <CurrentAddress></CurrentAddress>
          </v-flex>
          <v-flex xs12>
            <HomeAddress></HomeAddress>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <AddressAdditionDialog></AddressAdditionDialog>
    <AddressEditDialog></AddressEditDialog>
    <ConfirmDeletionDialog></ConfirmDeletionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'
import CurrentAddress from './CurrentAddress'
import HomeAddress from './HomeAddress'
import AddressAdditionDialog from './AddressAdditionDialog'
import AddressEditDialog from './AddressEditDialog'
import ConfirmDeletionDialog from './ConfirmDeletionDialog'


export default {
  components: {
    CurrentAddress,
    HomeAddress,
    AddressAdditionDialog,
    AddressEditDialog,
    ConfirmDeletionDialog
  },
  created () {
    this.$store.dispatch('student/get_address', {
      student_id: this.$route.params.student_id
    })
  }
}
</script>
