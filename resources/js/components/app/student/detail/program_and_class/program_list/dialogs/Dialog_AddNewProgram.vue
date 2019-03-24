<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Add New Program</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Program" class="ca-label" prop="product_id">
                  <el-select 
                    v-model="form.product_id" 
                    class="ca-block"
                  >
                    <el-option
                      v-for="option in program_selection_options"
                      :key="option.id"
                      :label="option.name"
                      :value="option.product_id"
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
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
        <v-btn 
          color="primary" 
          flat
          @click="submit()"
          :loading="waiting_result"
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
    waiting_result: false,
    start_date_picker: false,
    completion_date_picker: false,
    form: {
      product_id: null,
      start_date: '',
      completion_date: ''
    },
    rules: {
      product_id: [
        { required: true, message: 'Please select program', trigger: 'change' }
      ],
      start_date: [
        { required: true, message: 'Please input start date', trigger: 'change' }
      ],
      completion_date: [
        { required: true, message: 'Please input completion date', trigger: 'change' }
      ]
    }
  }),
  computed: {
    program_selection_options () {
      return this.$store.getters['student/class/program_selection_options']
    }
  },
  watch: {
    is_active (n_val) {
      if (!n_val) {
        this.$refs['form'].resetFields()
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.waiting_result = true
          this.form.student_id = this.$route.params.student_id
          this.$store.dispatch('student/class/add_program', {
            form: this.form
          }).then(res => {
            this.waiting_result = false
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
    this.form.start_date = this.$moment().format('YYYY-MM-DD')
    bus.$on('open_dialog_program_addition', (payload) => {
      this.is_active = true
    })
  },
}
</script>