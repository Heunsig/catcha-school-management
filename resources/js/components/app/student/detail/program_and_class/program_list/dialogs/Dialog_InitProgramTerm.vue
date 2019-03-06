<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title></v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs6>
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
              </v-flex>
              <v-flex xs6>
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
                      :value="format_date(form.completion_date)"
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.completion_date"
                      :min="form.start_date"
                      @input="completion_date_picker = false"
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
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn flat color="primary" :loading="waiting_result" @click="submit()">Submit</v-btn>
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
      start_date_picker: false,
      completion_date_picker: false,
      is_active: false,
      waiting_result: false,
      form: {
        start_date: '',
        completion_date: ''
      },
      rules: {
        start_date: [
          { required: true, message: 'Please select start date', trigger: 'change' }
        ],
        completion_date: [
          { required: true, message: 'Please select completion date', trigger: 'change' }
        ]
      }
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
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    submit () {
      this.waiting_result = true
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.$store.dispatch('class/update_program_term', {
            program_id: this.program.id,
            form: this.form
          }).then(res => {
            this.waiting_result = false
            this.is_active = false
          })
        }
      })
    }
  },
  created () {
    bus.$on('dialog:init_program_term', payload => {
      this.is_active = true
      this.program = payload.program
    })
  }
}
</script>