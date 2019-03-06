<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Edit dates</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Start Date" class="ca-label" prop="start_date">
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
    dp_start_date: false,
    dp_completion_date: false,
    class_item: {},
    form: {
      start_date: '',
      completion_date: ''
    },
    rules: {
      start_date: [
        { required: true, message: 'Please select start date', trigger: 'change' }
      ],
    }
  }),
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
          this.$store.dispatch('class/edit_date', {
            class_in_program_id: this.class_item.id,
            form: this.form
          }).then(res => {
            this.waiting_result = false
            this.is_active = false
          })
        }
      })
    },
    format_date (date) {
      return this.$moment(date).format('MM/DD/YYYY')
    }
  },
  created () {
    bus.$on('open_dialog_date_edit', (payload) => {
      this.form.start_date = payload.start_date
      this.form.completion_date = payload.completion_date
      this.class_item = payload.class_item
      this.is_active = true
    })
  }
}
</script>