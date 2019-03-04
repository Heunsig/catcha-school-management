<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1100">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Edit Profile</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-2">
            <v-layout wrap>
              <v-flex xs7>
                <v-card height="638">
                  <v-card-text>
                    <v-container fluid class="pa-0 ca-grid-list-1">
                      <v-layout wrap>
                        <v-flex xs12>
                          <el-form-item label="First Nme" class="ca-label" prop="first_name">
                            <el-input v-model="form.first_name"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs7>
                          <el-form-item label="Last Nme" class="ca-label" prop="last_name">
                            <el-input v-model="form.last_name"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs5>
                          <el-form-item label="Middle Nme" class="ca-label" prop="middle_name">
                            <el-input v-model="form.middle_name"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Nickname" class="ca-label" prop="nickname">
                            <el-input v-model="form.nickname"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Email" class="ca-label" prop="email">
                            <el-input v-model="form.email"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Note" class="ca-label" prop="note">
                            <el-input
                              type="textarea"
                              :autosize="{ minRows: 6 }"
                              placeholder="Please input note"
                              v-model="form.note">
                            </el-input>
                          </el-form-item>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs5>
                <v-container fluid class="pa-0 ca-grid-list-1">
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-card>
                        <v-card-text>
                          <v-container fluid class="pa-0">
                            <v-flex xs12>
                              <el-form-item label="Type" class="ca-label" prop="type_id">
                                <el-select v-model="form.type_id" placeholder="Select" class="ca-block">
                                  <el-option
                                    v-for="option in type_options"
                                    :key="option.value"
                                    :label="option.key"
                                    :value="option.value">
                                  </el-option>
                                </el-select>
                              </el-form-item>
                            </v-flex>
                            <v-flex xs12>
                              <el-form-item label="Status" class="ca-label" prop="status_id">
                                <el-select v-model="form.status_id" placeholder="Select" class="ca-block">
                                  <el-option
                                    v-for="option in status_options"
                                    :key="option.value"
                                    :label="option.key"
                                    :value="option.value">
                                  </el-option>
                                </el-select>
                              </el-form-item>
                            </v-flex>
                          </v-container>
                        </v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs12>
                      <v-card>
                        <v-card-text>
                          <v-container fluid class="pa-0 ca-grid-list-1">
                            <v-layout wrap>
                              <v-flex xs12>
                                <el-form-item label="Sex" class="ca-label">
                                  <el-select v-model="form.sex" placeholder="Select" class="ca-block" prop="sex">
                                    <el-option
                                      v-for="option in sex_options"
                                      :key="option"
                                      :label="option"
                                      :value="option">
                                    </el-option>
                                  </el-select>
                                </el-form-item>
                              </v-flex>
                              <v-flex xs12>
                                <el-form-item label="Date of Birth" class="ca-label" prop="date_or_birth">
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
                              <v-flex xs12>
                                <el-form-item label="City of Birth" class="ca-label" prop="city_of_birth">
                                  <el-input v-model="form.city_of_birth"></el-input>
                                </el-form-item>
                              </v-flex>
                              <v-flex xs6>
                                <el-form-item label="Country of Birth" class="ca-label" prop="country_of_birth">
                                  <el-select v-model="form.country_of_birth" filterable placeholder="Select" class="ca-block">
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
                                <el-form-item label="Country of Citizenship" class="ca-label" prop="country_of_citizenship">
                                  <el-select v-model="form.country_of_citizenship" filterable placeholder="Select" class="ca-block">
                                    <el-option
                                      v-for="option in countries"
                                      :key="option.name"
                                      :label="option.name"
                                      :value="option.code">
                                    </el-option>
                                  </el-select>
                                </el-form-item>
                              </v-flex>
                            </v-layout>
                          </v-container>
                        </v-card-text>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn 
          flat
          color="primary"
          @click="submit()"
          :loading="loading"
        >Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
import countries from '../../../../../../mixins/countries'
export default {
  mixins: [
    countries
  ],
  data () {
    return {
      loading: false,
      is_active: false,
      status_options: [],
      type_options: [],
      sex_options: ['Male', 'Female'],
      date_of_birth_picker: false,
      form: {
        type_id: '',
        status_id: '',
        email: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        nickname: '',
        date_of_birth: '',
        country_of_birth: '',
        city_of_birth: '',
        country_of_citizenship: '',
        sex: '',
        note: ''
      },
      rules: {
        type_id: [
          { required: true, message: 'Please select status', trigger: 'change' },
        ],
        status_id: [
          { required: true, message: 'Please select status', trigger: 'change' },
        ],
        first_name: [
          { required: true, message: 'Please input first name', trigger: ['blur', 'change'] },
        ]
      }
    }
  },
  methods: {
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          // here
          // this.wating_result = true
          // this.$axios.post(`/student`, this.form).then(res => {
          //   this.wating_result = false
          //   this.created_student_name = this.form.first_name
          //   this.created_student_id = res.data.student_id
          //   this.snackbar = true
          //   this.clear()
          // })
          this.loading = true
          this.$store.dispatch('student/update_basic', {
            student_id: this.$route.params.student_id,
            form: this.form
          }).then(res => {
            this.is_active = false
            this.loading = false
          })
        }
      });
      // this.loading = true
      // this.$store.dispatch('student/update_basic', {
      //   student_id: this.$route.params.student_id,
      //   form: this.form
      // }).then(res => {
      //   this.is_active = false
      //   this.loading = false
      // })
    }
  },
  created () {
    bus.$on('open_dialog_basic_information_edit', payload => {
      this.is_active = true
      console.log('form', this.form)
      this.form = payload.form
    })

    this.$axios.get('/student/register').then(res => {
      this.status_options = res.data.status_options
      this.type_options = res.data.type_options
    })
  }
}
</script>
<style scoped>
  .v-card {
    box-shadow: none!important;
  }
</style>