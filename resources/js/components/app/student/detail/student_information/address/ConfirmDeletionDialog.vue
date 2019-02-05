<template>
  <v-dialog v-model="is_active" persistent max-width="270">
    <v-card>
      <v-card-text>
        Do you want to delete?
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat @click="is_active = false">Disagree</v-btn>
        <v-btn flat @click="confirm_deletion()">Agree</v-btn>
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
      address_id: null
    }
  },
  methods: {
    confirm_deletion () {
      this.$store.dispatch('student/delete_address', {
        address_id: this.address_id
      }).then(res => {
        this.is_active = false
      })
    }
  },
  created () {
    bus.$on('open_dialog_address_deletion', (payload) => {
      this.is_active = true
      this.address_id = payload.address_id
    })
  }
}
</script>