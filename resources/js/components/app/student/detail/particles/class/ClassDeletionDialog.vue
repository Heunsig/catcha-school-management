<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-title-4">Do you want to delete {{ selected_classinfo.name }}?</v-card-title>
      <v-card-text>
        
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" flat @click="$emit('close')">Disagree</v-btn>
        <v-btn color="green darken-1" flat @click="delete_class()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  props: [
    'is_active',
    'selected_classinfo',
    'fn_open_deletion_dialog'
  ],
  data: () => ({

  }),
  methods: {
    delete_class () {
      console.log(this.selected_classinfo)
      this.$axios.post(`/student/${this.$route.params.student_id}/class/delete`,{
        class_id: this.selected_classinfo.id
      }).then(res => {
        this.$emit('del', {
          original_obj: this.selected_classinfo
        })
        this.$emit('close')
        // console.log('res', res)
        // this.$emit('del', {
        //   original_obj: this.selected_classinfo
        // })
      })
    }
  }
}
</script>