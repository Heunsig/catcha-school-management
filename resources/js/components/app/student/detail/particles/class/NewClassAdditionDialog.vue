<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Add New Class
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Program" class="ca-label">
                  <el-input 
                    :value="program.name"
                    :disabled="true"
                  ></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Class" class="ca-label">
                  <el-select 
                    v-model="form.classinfo_id" 
                    placeholder="Select"
                    class="ca-block"
                  >
                    <el-option
                      v-for="option in class_selection_options"
                      :key="option.id"
                      :label="option.name"
                      :value="option.id"
                    >
                    </el-option>
                  </el-select>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Start Date" class="ca-label">
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
                      :value="format_date(form.start_date)"
                      placeholder="Please input" 
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.start_date"
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

// function initial_data () {
//   return {
//     program: {},
//     is_active: false,
//     wating_result: false,
//     date_picker: false,
//     form: {
//       program_id: null,
//       classinfo_id: null,
//       student_id: null,
//       start_date: ''
//     }
//   }
// }

export default {
  data: () => ({
    program: {},
    is_active: false,
    wating_result: false,
    date_picker: false,
    form: {
      program_id: null,
      classinfo_id: null,
      student_id: null,
      start_date: ''
    }
  }),
  computed: {
    class_selection_options () {
      return this.$store.getters['class/class_selection_options']
    },
    // program_selection_options () {
    //   return this.$store.getters['class/program_selection_options']
    // }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data({
          form: {
            start_date: this.$moment().format('YYYY-MM-DD')  
          }
        })
      }
    }
  },
  methods: {
    submit () {
      this.form.program_id = this.program.id
      this.form.student_id = this.$route.params.student_id
      
      this.wating_result = true
      this.$store.dispatch('class/add_class', {
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
    bus.$on('open_dialog_class_addition', (payload) => {
      this.is_active = true
      this.program = payload.program
    })
  }
}
</script>