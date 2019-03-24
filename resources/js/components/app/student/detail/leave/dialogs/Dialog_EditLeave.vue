<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="500">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Edit Leave of Absence</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Type of Leave" class="ca-label" prop="leave_type_id">
                  <el-select 
                    v-model="form.leave_type_id" 
                    placeholder="Select type of leave"
                    class="ca-block"
                  >
                    <el-option
                      v-for="option in leave_types"
                      :key="option.id"
                      :label="option.value"
                      :value="option.id"
                    >
                    </el-option>
                  </el-select>
                </el-form-item>
              </v-flex>
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
                      placeholder="Please input" 
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
                      placeholder="Please input" 
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
        <v-btn 
          flat
          color="primary"
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
    leave_request: {},
    is_active: false,
    wating_result: false,
    start_date_picker: false,
    completion_date_picker: false,
    form: {
      leave_type_id: null,
      start_date: '',
      completion_date: ''
    },
    rules: {
      leave_type_id: [
        { required: true, message: 'Please select type', trigger: 'change' }
      ],
      start_date: [
        { required: true, message: 'Please select start date', trigger: 'change' }
      ],
      completion_date: [
        { required: true, message: 'Please select completion date', trigger: 'change' }
      ]
    }
  }),
  computed: {
    leave_types () {
      return this.$store.getters['student/leave/leave_types']
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
      this.wating_result = true
      this.$store.dispatch('student/leave/edit', {
        leave_id: this.leave_request.id,
        form: this.form
      }).then(res => {
        this.wating_result = false
        this.is_active = false
        this.open_dialog_program_attachment({
          reason: `${this.leave_request.leave_type} (${this.leave_request.start_date} - ${this.leave_request.completion_date}) is edited to ${res.data.leave_type} (${res.data.start_date} - ${res.data.completion_date})`
        })
      })
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    open_dialog_program_attachment (payload) {
      bus.$emit('open_dialog_program_attachment', payload)
    }
  },
  created () {
    bus.$on('open_dialog_leave_edit', (payload) => {
      this.is_active = true
      this.leave_request = payload.leave_request
      this.form.leave_type_id = this.leave_request.leave_type_id
      this.form.start_date = this.leave_request.start_date
      this.form.completion_date = this.leave_request.completion_date
    })
  }
}
</script>