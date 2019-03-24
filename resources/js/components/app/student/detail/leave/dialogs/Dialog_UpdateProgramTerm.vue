<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="500">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        <span>Attach Programs</span>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Programs" class="ca-label">
                  <el-select 
                    v-model="form.program_ids"  
                    multiple 
                    placeholder="Choose programs which will be applied"
                    class="ca-block"
                  >
                    <el-option
                      v-for="item in programs_taken"
                      :key="item.id"
                      :label="item.name"
                      :value="item.id">
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
              <v-flex xs12>
                <el-form-item label="Reason" class="ca-label">
                  <el-input 
                    v-model="form.reason"
                    placeholder="Please input reason"
                  ></el-input>
                </el-form-item>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat @click="is_active = false">Disagree</v-btn>
        <v-btn 
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
  data () {
    return {
      wating_result: false,
      is_active: false,
      start_date_picker: false,
      completion_date_picker: false,
      form: {
        program_ids: [],
        start_date: '',
        completion_date: '',
        reason: ''
      }
    }
  },
  computed: {
    programs_taken () {
      return this.$store.getters['student/leave/programs_taken']
    }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data()
      }
    }
  },
  methods: {
    submit () {
      // console.log('submit!!!')
      this.wating_result = true
      this.$store.dispatch('student/leave/update_programs_date', {
        form: this.form
      }).then(res => {
        this.wating_result = true
        this.is_active = false
      })
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    }
  },
  created () {
    bus.$on('open_dialog_program_attachment', (payload) => {
      this.is_active = true
      this.form.reason = payload.reason
    })
  }
}
</script>