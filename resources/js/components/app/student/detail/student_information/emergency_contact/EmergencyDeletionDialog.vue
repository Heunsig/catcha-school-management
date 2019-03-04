<template>
  <v-dialog v-model="is_active" persistent max-width="270">
    <v-card>
      <v-card-text>Do you want to clear?</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn flat color="primary" :loading="wating_result" @click="submit()">Confirm</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data () {
    return {
      is_active: false,
      emergency_contact_id: null,
      wating_result: false
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$store.dispatch('student/delete_emergency_contact',{
        emergency_contact_id: this.emergency_contact_id
      }).then(res => {
        this.wating_result = false
        this.is_active = false
      })
    }
  },
  created () {
    bus.$on('open_dialog_emergency_delete', (payload) => {
      this.is_active = true
      this.emergency_contact_id = payload.emergency_contact_id
    })
  }
}
</script>