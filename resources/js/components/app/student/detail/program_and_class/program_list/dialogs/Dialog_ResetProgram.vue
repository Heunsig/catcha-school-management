<template>
  <v-dialog v-model="is_active" max-width="300">
    <v-card>
      <v-card-title>
        <h5 class="ca-typo-title-5">Do you want to reset all history of this program?</h5>
      </v-card-title>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn flat color="primary" :loading="waiting_result" @click="submit()">Continue</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data () {
    return {
      program: {},
      waiting_result: false,
      is_active: false
    }
  },
  methods: {
    submit () {
      this.waiting_result = true
      this.$store.dispatch('class/reset_program', {
        program_id: this.program.id
      }).then(res => {
        this.waiting_result = false
        this.is_active = false
      })
    },
  },
  created () {
    bus.$on('dialog:program_reset', payload => {
      this.is_active = true
      this.program = payload.program
    })
  }
}
</script>