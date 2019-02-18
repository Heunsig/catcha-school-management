<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Add New Program
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Program" class="ca-label">
                  <el-select 
                    v-model="form.product_id" 
                    placeholder="Select"
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
                <el-form-item label="Start Date" class="ca-label">
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
                      @input="start_date_picker = false"
                    ></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex>
              <v-flex xs6>
                <el-form-item label="Completion Date" class="ca-label">
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
        <v-btn color="green darken-1" flat @click="is_active = false">Disagree</v-btn>
        <v-btn 
          color="green darken-1" 
          flat 
          @click="submit()"
          :loading="wating_result"
        >
          Agree
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
    start_date_picker: false,
    completion_date_picker: false,
    form: {
      product_id: null,
      start_date: '',
      completion_date: ''
    }
  }),
  computed: {
    program_selection_options () {
      return this.$store.getters['class/program_selection_options']
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.form.student_id = this.$route.params.student_id
      this.$store.dispatch('class/add_program', {
        form: this.form
      }).then(res => {
        this.wating_result = false
        this.is_active = false
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