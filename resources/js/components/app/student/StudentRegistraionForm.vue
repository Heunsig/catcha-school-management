<template>
  <el-form ref="form" :model="form" :rules="rules" label-position="top">
    <v-container fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs7>
          <v-card height="700">
            <v-card-text>
              <v-container fluid>
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
          <v-container fluid class="pa-0">
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
                    <v-container fluid class="pa-0">
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
                            <el-input v-model="form.date_of_birth"></el-input>
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
    <v-snackbar
      v-model="snackbar"
      top
      color="success"
      :timeout="3000"
    >
      <a 
        @click="$router.push({name: 'student.information.basic_information', params:{student_id: created_student_id}})"
      >
        <span class="mr-2">{{ created_student_name }}</span>
      </a> 
        has been created.
      <v-btn
        flat
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
    <ca-floating-box top="100" right="28">
      <v-btn
        color="pink"
        dark
        fab
        @click="clear()"
      >
        <v-icon>replay</v-icon>
      </v-btn>
      <v-btn
        color="pink"
        dark
        fab
        @click="submit()"
        :loading="wating_result"
      >
        <v-icon>send</v-icon>
      </v-btn>
    </ca-floating-box>
  </el-form>
</template>
<script>

import countriesMixin from '../../../mixins/countries.js'
export default {
  mixins: [
    countriesMixin
  ],
  data () {
    return {
      created_student_name: '',
      created_student_id: null,
      snackbar: false,
      wating_result: false,
      status_options: [],
      type_options: [],
      sex_options: ['Male', 'Female'],
      form: {
        type_id: '',
        status_id: '1',
        email: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        nickname: '',
        date_of_birth: '',
        country_of_birth: '',
        country_of_citizenship: '',
        city_of_birth: '',
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
          { required: true, message: 'Please input first name', trigger: 'blur' },
        ]
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          // console.log('hi')
          this.wating_result = true
          this.$axios.post(`/student`, this.form).then(res => {
            console.log('res', res)
            this.wating_result = false
            this.created_student_name = this.form.first_name
            this.created_student_id = res.data.student_id
            this.snackbar = true
            this.clear()
          })
        }
      });
    },
    clear () {
      this.$refs['form'].resetFields()
    }
  },
  created () {
    this.$axios.get('/student/register').then(res => {
      this.status_options = res.data.status_options
      this.type_options = res.data.type_options
    })
  }
}
</script>