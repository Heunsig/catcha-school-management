<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-title-4">Add New Class</v-card-title>
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
                  v-model="computedDateFormatted"
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
        <v-btn color="green darken-1" flat @click="$emit('close')">Disagree</v-btn>
        <v-btn color="green darken-1" flat @click="add_class()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  props: [
    'is_active',
    'classes'
  ],
  data: () => ({
    date_picker: false,
    start_date: '',
    selected_class_id: null,
  }),
  computed: {
    computedDateFormatted () {
      return this.formatDate(this.start_date)
    }
  },
  methods: {
    formatDate (date) {
      if (!date) return null

      const [year, month, day] = date.split('-')
      return `${month}/${day}/${year}`
    },
    add_class () {
      this.$axios.post(`/student/${this.$route.params.student_id}/class`, {
        classinfo_id: this.selected_class_id,
        start_date: this.start_date
      }).then(res => {
        console.log('res s', res)
        this.$emit('add_class', res.data)
        this.$emit('close')
      })
    },
  },
  created () {
    this.start_date = this.$moment().format("YYYY-MM-DD")
  },
}
</script>