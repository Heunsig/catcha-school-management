<template>
  <v-dialog v-model="is_active" persistent max-width="500">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        New Program Term Update
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
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
              <v-flex xs12>
                <el-form-item label="Reason" class="ca-label">
                  <el-input placeholder="Please reason" v-model="form.reason"></el-input>
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
    program: {},
    start_date_picker: false,
    completion_date_picker: false,
    form: {
      start_date: '',
      completion_date: '',
      reason: '',
    }
  }),
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data()
      } 
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$store.dispatch('class/update_program_term', {
        program_id: this.program.id,
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
    bus.$on('open_dialog_program_term_update', (payload) => {
      this.is_active = true
      this.program = payload.program
    })
  },
}
</script>