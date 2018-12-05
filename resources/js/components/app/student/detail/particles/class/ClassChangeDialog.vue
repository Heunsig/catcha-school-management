<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-title-4">"{{ selected_class_item.name }}" moves to which?</v-card-title>
      <v-card-text>
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <v-select
                v-model="selected_class_id"
                :items="classes"
                item-text="name"
                item-value="id"
                label="Choose Class"
              ></v-select>
            </v-flex>
            <v-flex xs12>
              <v-menu
                :close-on-content-click="false"
                v-model="date_picker"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  v-model="date_formatted"
                  label="When does this student begin the class?"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="start_date" @input="date_picker = false"></v-date-picker>
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
  props: [
    'classes'
  ],
  data: () => ({
    is_active: false,
    date_picker: false,
    start_date: '',
    selected_class_id: null,
    selected_class_item: {},
    selected_group: []
  }),
  computed: {
    date_formatted () {
      return this.$moment(this.start_date).format('MM/DD/YYYY')
    }
  },
  methods: {
    submit () {
      this.$emit('submit', {
        classinfo_id: this.selected_class_id,
        start_date: this.start_date,
        selected_class_item: this.selected_class_item,
        selected_group: this.selected_group
      })
      this.is_active = false
    }
  },
  created () {
    this.start_date = this.$moment().format("YYYY-MM-DD")
    bus.$on('open_dialog_class_change', (payload) => {
      this.selected_class_item = payload.selected_class_item
      this.selected_group = payload.selected_group
      this.is_active = true
    })
  }
}
</script>
