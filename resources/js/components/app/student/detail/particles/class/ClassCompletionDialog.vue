<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Class Completion
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Completion Date" class="ca-label">
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
                      placeholder="Please input" 
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
    // program: {},
    class_item: {},
    date_picker: false,
    is_active: false,
    wating_result: false,
    form: {
      completion_date: ''
    }
  }),
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data({
          form: {
            completion_date: this.$moment().format('YYYY-MM-DD')
          }
        })
      }
    }
  },
  methods: {
    submit () {
      // console.log('f', this.form)
      this.wating_result = true
      this.$store.dispatch('class/complete_class', {
        class_in_program_id: this.class_item.id,
        form: this.form
      }).then(res => {
        this.is_active = false
        this.wating_result = false
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