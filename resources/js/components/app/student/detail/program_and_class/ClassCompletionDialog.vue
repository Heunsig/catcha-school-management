<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Complete Class</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Completion Date" class="ca-label" prop="completion_date">
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
                    <el-input 
                      slot="activator"
                      :value="format_date(form.completion_date)"
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.completion_date"
                      @input="date_picker = false"
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
    // program: {},
    class_item: {},
    date_picker: false,
    is_active: false,
    wating_result: false,
    form: {
      completion_date: ''
    },
    rules: {
      completion_date: [
        { required: true, message: 'Please select completion date', trigger: 'change' }
      ]
    }
  }),
  watch: {
    is_active (n_val) {
      if (!n_val) {
        this.$refs['form'].resetFields()
      } else {
        this.form.completion_date = this.$moment().format('YYYY-MM-DD')
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.$store.dispatch('class/complete_class', {
            class_in_program_id: this.class_item.id,
            form: this.form
          }).then(res => {
            this.is_active = false
            this.wating_result = false
          })
        }
      })
      // this.form.program_id = this.program.id
      // this.form.student_id = this.$route.params.student_id
      
      // this.wating_result = true
      // this.$store.dispatch('class/add_class', {
      //   form: this.form
      // }).then(res => {
      //   this.wating_result = false
      //   this.is_active = false
      // })
    },
    format_date (date) {
      return this.$moment(date).format('MM/DD/YYYY')
    }
  },
  created () {
    this.form.completion_date = this.$moment().format('YYYY-MM-DD')
    bus.$on('open_dialog_class_completion', (payload) => {
      this.is_active = true
      this.class_item = payload.class_item
      // this.program = payload.program
    })
  }
}
</script>