<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Delete Class
      </v-card-title>
      <v-card-text>
        
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
        <v-btn color="primary" flat :loading="wating_result" @click="submit()">Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data: () => ({
    is_active: false,
    wating_result: false,
    selected_student_class: {},
  }),
  methods: {
    submit () {
      this.wating_result = true
      this.$store.dispatch('class/del_class', {
        student_id: this.$route.params.student_id,
        pivot_id: this.selected_student_class.id
      }).then(res => {
        this.wating_result = false
        this.is_active = false
      })
    }
  },
  created () {
    bus.$on('open_dialog_deletion', (payload) => {
      this.selected_student_class = payload.student_class
      this.is_active = true
    })
  }
}
</script>