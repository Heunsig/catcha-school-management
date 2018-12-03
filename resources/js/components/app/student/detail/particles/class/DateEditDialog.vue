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
                  :value="computedDateFormatted(this.editable_start_date)"
                  label="When does this student begin the class?"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="editable_start_date" @input="dp_start_date = false"></v-date-picker>
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
                :disabled="is_completion ? false:true"
              >
                <v-text-field
                  slot="activator"
                  :value="computedDateFormatted(this.editable_completion_date)"
                  label="When does this student begin the class?"
                  prepend-icon="event"
                  readonly
                  :disabled="is_completion ? false:true"
                ></v-text-field>
                <v-date-picker v-model="editable_completion_date" @input="dp_completion_date = false"></v-date-picker>
              </v-menu>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" flat @click="$emit('close')">Disagree</v-btn>
        <v-btn color="green darken-1" flat @click="edit_date()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  props: [
    'is_active',
    'start_date',
    'completion_date',
    'selected_classinfo'
  ],
  data: () => ({
    dp_start_date: false,
    dp_completion_date: false,
    editable_start_date: '',
    editable_completion_date: ''
  }),
  computed: {
    is_completion () {
      if (this.selected_classinfo.completion_date) {
        return true
      }

      return false
    }
  },
  watch: {
    is_active (val) {
      if (val) {
        this.editable_start_date = this.start_date
        this.editable_completion_date = ''
        if (this.is_completion) {
          this.editable_completion_date = this.completion_date  
        }
      }
    }
  },
  methods: {
    edit_date () {
      this.$axios.post(`/student/${this.$route.params.student_id}/class/edit_date`, {
        class_id: this.selected_classinfo.id,
        start_date: this.editable_start_date,
        completion_date: this.editable_completion_date
      }).then(res => {
        this.$emit('edit', {
          original_obj: this.selected_classinfo,
          edited_obj: res.data
        })
        this.$emit('close')
      })
    },
    formatDate (date) {
      if (!date) return null

      const [year, month, day] = date.split('-')
      return `${month}/${day}/${year}`
    },
    computedDateFormatted (date) {
      return this.formatDate(date)
    }
  },
}
</script>