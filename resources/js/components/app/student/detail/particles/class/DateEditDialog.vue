<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Edit dates
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Start Date" class="ca-label">
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
                    <el-input 
                      slot="activator"
                      :value="format_date(form.start_date)"
                      placeholder="Please input" 
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.start_date"
                      @input="dp_start_date = false"
                    ></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Completion Date" class="ca-label">
                  <v-menu
                    :close-on-content-click="false"
                    v-model="dp_completion_date"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                    :disabled="form.completion_date === null"
                  >
                    <el-input 
                      slot="activator"
                      :value="form.completion_date ? format_date(form.completion_date):''"
                      :placeholder="form.completion_date ? 'Please input completion date':'Can\'t choose completion date'" 
                      readonly
                      :disabled="form.completion_date === null"
                    ></el-input>
                    <v-date-picker
                      v-model="form.completion_date"
                      @input="dp_completion_date = false"
                    ></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
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
    selected_student_class: {},
    form: {
      start_date: '',
      completion_date: ''
    }
  }),
  methods: {
    submit () {
      this.$store.dispatch('class/edit_date', {
        student_id: this.$route.params.student_id,
        pivot_id: this.selected_student_class.id,
        form: this.form
      }).then(res => {
        this.is_active = false
      })
    },
    is_completed_class () {
      if (this.selected_student_class.completion_date) {
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
      this.form.start_date = payload.start_date
      this.form.completion_date = payload.completion_date
      this.selected_student_class = payload.item
      this.is_active = true
    })
  }
}
</script>