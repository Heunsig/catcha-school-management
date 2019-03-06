<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1100">
    <v-card>
      <v-card-title>
        Bus Letter
      </v-card-title>
      <v-card-text>
        <v-container fluid class="pa-0 ca-grid-list-2">
          <v-layout wrap>
            <v-flex xs8>
              <v-card>
                <v-card-title>Form</v-card-title>
                <v-card-text>
                  <el-form ref="form" :model="form" :rules="rules" label-position="top">
                    <v-container fluid class="pa-0 ca-grid-list-1">
                      <v-layout wrap>
                        <v-flex xs4>
                          <el-form-item label="First Name" class="ca-label" prop="first_name">
                            <el-input 
                              v-model="form.first_name"
                            ></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs4>
                          <el-form-item label="Middle Name" class="ca-label" prop="middle_name">
                            <el-input 
                              v-model="form.middle_name"
                            ></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs4>
                          <el-form-item label="Last Name" class="ca-label" prop="last_name">
                            <el-input 
                              v-model="form.last_name"
                            ></el-input>
                          </el-form-item>
                        </v-flex>
                        <!-- <v-flex xs12>
                          <el-form-item label="Name" class="ca-label" prop="name">
                            <el-input 
                              v-model="form.name"
                            ></el-input>
                          </el-form-item>
                        </v-flex> -->
                        <v-flex xs2>
                          <el-form-item label="Sex" class="ca-label" prop="sex">
                            <el-select 
                              v-model="form.sex" 
                              filterable
                              placeholder="Select"
                              class="ca-block"
                            >
                              <el-option
                                v-for="option in sex_options"
                                :key="option"
                                :label="option"
                                :value="option"
                              >
                              </el-option>
                            </el-select>
                          </el-form-item>
                        </v-flex> 
                        <v-flex xs4>
                          <el-form-item label="Date of Birth" class="ca-label" prop="date_of_birth">
                            <v-menu
                              :close-on-content-click="false"
                              v-model="date_of_birth_picker"
                              :nudge-right="40"
                              lazy
                              transition="scale-transition"
                              offset-y
                              full-width
                              min-width="290px"
                            >
                              <el-input 
                                slot="activator"
                                :value="format_date(form.date_of_birth)"
                                readonly
                              ></el-input>
                              <v-date-picker
                                v-model="form.date_of_birth"
                                @input="date_of_birth_picker = false"
                              ></v-date-picker>
                            </v-menu>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs6>
                          <el-form-item label="Country of Citizenship" class="ca-label" prop="country_of_citizenship">
                            <el-select v-model="form.country_of_citizenship" filterable class="ca-block">
                              <el-option
                                v-for="option in countries"
                                :key="option.name"
                                :label="option.name"
                                :value="option.code">
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
                        <v-flex xs12>
                          <el-form-item label="Issuing Date" class="ca-label" prop="issuing_date">
                            <v-menu
                              :close-on-content-click="false"
                              v-model="issuing_date_picker"
                              :nudge-right="40"
                              lazy
                              transition="scale-transition"
                              offset-y
                              full-width
                              min-width="290px"
                            >
                              <el-input 
                                slot="activator"
                                :value="format_date(form.issuing_date)"
                                readonly
                              ></el-input>
                              <v-date-picker
                                v-model="form.issuing_date"
                                @input="issuing_date_picker = false"
                              ></v-date-picker>
                            </v-menu>
                          </el-form-item>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </el-form>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs4>
              <v-card>
                <v-card-title>
                  Programs Taken
                </v-card-title>
                <v-card-text style="overflow:auto;height:416px;">
                  <ul class="insty-program-box">
                    <li v-for="program in programs">
                      <div>{{ program.name }}</div>
                      <ul>
                        <li v-for="date in program.dates">
                          <div class="insty-start-date" @click="select_start_date(date.start_date)">{{ $moment(date.start_date).format('M/DD/Y') }}</div>
                          <div class="insty-dashbar">-</div>
                          <div class="insty-completion-date" @click="select_completion_date(date.completion_date)">{{ $moment(date.completion_date).format('M/DD/Y') }}</div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn flat color="primary" @click="submit()">Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
import countries from '../../../../../../../mixins/countries'
export default {
  mixins: [
    countries
  ],
  data () {
    return {
      is_active: false,
      form: {
        issuing_date: '',
        sex: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        country_of_citizenship: '',
        date_of_birth: '',
        start_date: '',
        completion_date: '',
      },
      programs: [],
      sex_options: ['Male', 'Female'],
      start_date_picker: false,
      completion_date_picker: false,
      issuing_date_picker: false,
      date_of_birth_picker: false,
      rules: {
        sex: [
          { required: true, message: 'Please select sex1', trigger: 'change' }
        ],
        first_name: [
          { required: true, message: 'Please input name', trigger: 'blur' }
        ],
        date_of_birth: [
          { required: true, message: 'Please input date of birth', trigger: 'change' }
        ],
        start_date: [
          { required: true, message: 'Please input start date', trigger: 'change' }
        ],
        completion_date: [
          { required: true, message: 'Please input completion date', trigger: 'change' }
        ],
        country_of_citizenship: [
          { required: true, message: 'Please select country of citizenship', trigger: 'change' }
        ],
        issuing_date: [
          { required: true, message: 'Please input issuing date', trigger: 'blur' }
        ]
      }
    }
  },
  computed: {
    student () {
      return this.$store.getters['student/student']
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
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    select_start_date (date) {
      this.form.start_date = this.$moment(date).format('YYYY-MM-DD')
    },
    select_completion_date (date) {
      this.form.completion_date = this.$moment(date).format('YYYY-MM-DD')
    },
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          window.open(`
              ${this.$config.BASE_URL}/document/busletter?
              first_name=${this.form.first_name}&
              middle_name=${this.form.middle_name ? this.form.middle_name : ''}&
              last_name=${this.form.last_name ? this.form.last_name : ''}&
              sex=${this.form.sex}&
              date_of_birth=${this.form.date_of_birth}&
              country_of_citizenship=${this.get_country(this.form.country_of_citizenship).name}&
              start_date=${this.form.start_date}&
              completion_date=${this.form.completion_date}&
              issuing_date=${this.form.issuing_date}
          `, '_blank');
        }
      })
    }
  },
  created () {
    bus.$on('dialog:bus_letter', payload => {
      // console.log('rr', this.student)
      this.is_active = true

      this.form.issuing_date = this.$moment().format('YYYY-MM-DD')

      this.form.first_name = this.student.first_name
      this.form.middle_name = this.student.middle_name
      this.form.last_name = this.student.last_name
      this.form.sex = this.student.sex ? this.student.sex:''
      // console.log('sex', this.student.sex)
      // console.log('date_of_birth', this.student.date_of_birth)
      this.form.date_of_birth = this.student.date_of_birth
      this.form.country_of_citizenship = this.student.country_of_citizenship ? this.student.country_of_citizenship:''


      this.$axios.get(`student/${this.$route.params.student_id}/program_term`).then(res => {
        // console.log('res', res)
        this.programs = res.data
      })
      // this.form.start_date = this.$moment().format('YYYY-MM-DD')
      // this.form.completion_date = this.$moment().format('YYYY-MM-DD')
    })
  }
}
</script>
<style scoped>
  .insty-program-box {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .insty-program-box > li {
    padding: 10px 0px;
  }

  .insty-program-box > li > div {
    font-size: 1.43em;
    margin-bottom: 5px;
  }

  .insty-program-box > li > ul > li {
    display: flex;
    padding: 3px 0px 3px 0px;
    align-items: center;
  }

  .insty-program-box .insty-dashbar {
    flex: 1 1 auto;
    text-align: center;
    font-weight: bold;
    font-size: 1.43em;
  }

  .insty-program-box ul {
    list-style: none;
    margin: 0;
    padding: 0; 
  } 

  .insty-program-box .insty-start-date, .insty-program-box .insty-completion-date {
    cursor: pointer;
  }

  .insty-program-box .insty-start-date:hover, .insty-program-box .insty-completion-date:hover {
    color: red;
  }
</style>