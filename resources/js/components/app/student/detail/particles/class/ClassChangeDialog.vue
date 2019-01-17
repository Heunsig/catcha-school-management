<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Change Class
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Class" class="ca-label">
                  <el-select 
                    v-model="form.classinfo_id" 
                    placeholder="Select"
                    class="ca-block"
                  >
                    <el-option
                      v-for="item in class_options"
                      :key="item.id"
                      :label="item.name"
                      :value="item.id"
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
        <v-btn color="green darken-1" flat @click="submit()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data: () => ({
    is_active: false,
    date_picker: false,
    selected_student_class: {},
    form: {
      classinfo_id: null,
      start_date: ''
    }
  }),
  computed: {
    class_options () {
      return this.$store.getters['class/class_options']
    }
  },
  methods: {
    submit () {
      this.$store.dispatch('class/change_class', {
        student_id: this.$route.params.student_id,
        pivot_id: this.selected_student_class.id,
        group: this.selected_student_class.group,
        form: this.form
      }).then(res => {
        this.is_active = false
      })
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
  },
  created () {
    this.form.start_date = this.$moment().format("YYYY-MM-DD")
    bus.$on('open_dialog_class_change', (payload) => {
      this.selected_student_class = payload.student_class
      this.is_active = true
    })
  }
}
</script>
