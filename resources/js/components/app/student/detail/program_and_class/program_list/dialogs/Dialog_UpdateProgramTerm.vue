<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Update Program Term</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <!-- <v-flex xs6>
                <el-form-item label="Start Date" class="ca-label" prop="start_date">
                  <v-menu
                    :close-on-content-click="false"
                    v-model="start_date_picker"
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
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.start_date"
                      :max="form.completion_date"
                      @input="start_date_picker = false"
                    ></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex> -->
              <v-flex xs12>
                <el-form-item label="Completion Date" class="ca-label" prop="completion_date">
                  <v-menu
                    :close-on-content-click="false"
                    v-model="completion_date_picker"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <el-input 
                      slot="activator"
                      prefix-icon="el-icon-date"
                      :value="format_date(form.completion_date)"
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.completion_date"
                      :min="$moment(last_completion_date).add(1, 'day').format('YYYY-MM-DD')"
                      @input="completion_date_picker = false"
                    ></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Reason" class="ca-label">
                  <el-input v-model="form.reason"></el-input>
                </el-form-item>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
        <v-btn 
          color="primary" 
          flat 
          @click="submit()"
          :loading="wating_result"
        >
          Submit
        </v-btn>
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
    program: {},
    start_date_picker: false,
    completion_date_picker: false,
    form: {
      start_date: '',
      completion_date: '',
      reason: '',
    },
    rules: {
      start_date: [
        { required: true, message: 'Please input start date', trigger: 'change' }
      ],
      completion_date: [
        { required: true, message: 'Please input completion date', trigger: 'change' }
      ]
    }
  }),
  computed: {
    last_completion_date () {
      return this.program.dates ? this._.last(this.program.dates).completion_date : ''
    }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.$refs['form'].resetFields()
      } 
    }
  },
  methods: {
    submit () {
      // console.log()
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.$store.dispatch('student/class/update_program_term', {
            program_id: this.program.id,
            form: this.form
          }).then(res => {
            this.wating_result = false
            this.is_active = false
          })
        }
      })
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
  },
  created () {
    bus.$on('open_dialog_program_term_update', (payload) => {
      this.is_active = true
      this.program = payload.program
      this.form.start_date = this.program.dates[0].start_date
    })
  },
}
</script>