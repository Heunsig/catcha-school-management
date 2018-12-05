<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-title-4">Do you want to delete {{ selected_class_item.name }}?</v-card-title>
      <v-card-text>
        
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" flat @click="is_active = false">Disagree</v-btn>
        <v-btn color="green darken-1" flat @click="submit()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data: () => ({
    is_active: false,
    selected_class_item: {},
    selected_group: []
  }),
  methods: {
    submit () {
      this.$emit('submit', {
        selected_class_item: this.selected_class_item,
        selected_group: this.selected_group
      })
      this.is_active = false
    }
  },
  created () {
    bus.$on('open_dialog_deletion', (payload) => {
      this.selected_class_item = payload.selected_class_item
      this.selected_group = payload.selected_group
      this.is_active = true
    })
  }
}
</script>