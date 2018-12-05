<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-title-4">Add New Class</v-card-title>
      <v-card-text>
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <v-menu
                :close-on-content-click="false"
                v-model="dp_start_date"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"

              >
                <v-text-field
                  slot="activator"
                  :value="format_date(start_date)"
                  label="When does this student begin the class?"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="start_date" @input="dp_start_date = false"></v-date-picker>
              </v-menu>
            </v-flex>
            <v-flex xs12>
              <v-menu
                :close-on-content-click="false"
                v-model="dp_completion_date"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
                :disabled="is_completed_class() ? false:true"
              >
                <v-text-field
                  slot="activator"
                  :value="format_date(completion_date)"
                  label="When does this student begin the class?"
                  prepend-icon="event"
                  readonly
                  :disabled="is_completed_class() ? false:true"
                ></v-text-field>
                <v-date-picker v-model="completion_date" @input="dp_completion_date = false"></v-date-picker>
              </v-menu>
            </v-flex>
          </v-layout>
        </v-container>
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
    dp_start_date: false,
    dp_completion_date: false,
    start_date: '',
    completion_date: '',
    selected_class_item: {},
    selected_group: []
  }),
  methods: {
    submit () {
      this.$emit('submit', {
        start_date: this.start_date,
        completion_date: this.completion_date,
        selected_class_item: this.selected_class_item,
        selected_group: this.selected_group
      })
      this.is_active = false
    },
    is_completed_class () {
      if (this.selected_class_item.completion_date) {
        return true
      }

      return false
    },
    format_date (date) {
      return this.$moment(date).format('MM/DD/YYYY')
    }
  },
  created () {
    bus.$on('open_dialog_date_edition', (payload) => {
      this.start_date = payload.start_date
      this.completion_date = payload.completion_date
      this.selected_class_item = payload.item
      this.selected_group = payload.group
      this.is_active = true
    })
  }
}
</script>