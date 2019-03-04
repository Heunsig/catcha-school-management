<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1100">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Add Emergency Contact</h4>
      </v-card-title>
      <v-card-text style="background:#f3f3f3;">
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-3">
            <v-layout wrap>
              <v-flex xs5>
                <v-card>
                  <v-card-text>
                    <v-container fluid class="pa-0 ca-grid-list-1">
                      <v-layout wrap>
                        <v-flex xs12>
                          <el-form-item label="Relationship" class="ca-label" prop="relationship">
                            <el-select 
                              v-model="form.relationship"
                              allow-create
                              filterable
                              class="ca-block"
                            >
                              <el-option
                                v-for="option in relationship_options"
                                :key="option"
                                :label="option"
                                :value="option"
                              >
                              </el-option>
                            </el-select>
                            <el-input 
                              class="mt-2"
                              v-model="form.etc"
                              v-if="form.relationship === 'ETC'"
                            ></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Name" class="ca-label" prop="name">
                            <el-input v-model="form.name"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Email" class="ca-label" prop="email">
                            <el-input v-model="form.email"></el-input>
                          </el-form-item>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs7>
                <v-card height="321">
                  <v-card-text>
                    <v-container fluid class="pa-0 ca-grid-list-1">
                      <v-layout wrap>
                        <v-flex xs12>
                          <el-form-item label="Type" class="ca-label">
                            <el-select 
                              v-model="form.type" 
                              filterable
                              class="ca-block"
                            >
                              <el-option
                                v-for="option in types"
                                :key="option"
                                :label="option"
                                :value="option"
                              >
                                <span>{{ option }}</span>
                              </el-option>
                            </el-select>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs5>
                          <el-form-item label="Country Dial Code" class="ca-label">
                            <el-select 
                              v-model="form.country_code" 
                              filterable
                              class="ca-block"
                            >
                              <el-option
                                v-for="option in countries"
                                :key="option.code"
                                :label="option.name"
                                :value="option.dial_code"
                              >
                                <span style="float: left">{{ option.name }}</span>
                                <span style="float: right; color: #8492a6; font-size: 13px">+{{ option.dial_code }}</span>
                              </el-option>
                            </el-select>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs7>
                          <el-form-item label="Contact Number" class="ca-label">
                            <el-input v-model="form.number">
                              <template slot="prepend">
                                <span v-if="form.country_code">+{{ form.country_code }}</span>
                              </template>
                            </el-input>
                          </el-form-item>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12>
                <v-card>
                  <v-card-text>
                    <v-container fluid class="pa-0 ca-grid-list-2">
                      <v-layout wrap>
                        <v-flex xs12>
                          <el-form-item label="Address line 1" class="ca-label">
                            <el-input placeholder="Please input" class="mb-1" v-model="form.address_line1"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Address line 2" class="ca-label">
                            <el-input placeholder="Please input" class="mb-1" v-model="form.address_line2"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs4>
                          <el-form-item label="City" class="ca-label">
                            <el-input placeholder="Please input" v-model="form.city"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs4>
                          <el-form-item label="State" class="ca-label">
                            <el-input placeholder="Please input" v-model="form.state"></el-input>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs4>
                          <el-form-item label="Country" class="ca-label">
                            <el-select 
                              v-model="form.country" 
                              filterable
                              class="ca-block"
                            >
                              <el-option
                                v-for="option in countries"
                                :key="option.code"
                                :label="option.name"
                                :value="option.code"
                              >
                              </el-option>
                            </el-select>
                          </el-form-item>
                        </v-flex>
                        <v-flex xs12>
                          <el-form-item label="Postal code" class="ca-label">
                            <el-input v-model="form.postal_code"></el-input>
                          </el-form-item>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn 
          flat 
          color="grey darken-2"
          @click="is_active = false">Close</v-btn>
        <v-btn 
          flat 
          color="primary" 
          :loading="wating_result"
          @click="submit()"
        >Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
import countriesMixin from '../../../../../../mixins/countries'
export default {
  props: [
    'relationship_options',
    'types'
  ],
  mixins: [
    countriesMixin
  ],
  data () {
    return {
      is_active: false,
      wating_result: false,
      form: {
        name: '',
        relationship: '',
        etc: '',
        country_code: '',
        number: '',
        type: '',
        email: '',
        address_line1: '',
        address_line2: '',
        city: '',
        state: '',
        postal_code: '',
        country: ''
      },
      rules: {
        relationship: [
          { required: true, message: 'Please select relationship', trigger: 'change' }
        ],
        name: [
          { required: true, message: 'Please input email', trigger: 'blur' }
        ],
        email: [
          { required: true, message: 'Please input email', trigger: 'blur' }
        ]
      }
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
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.form.student_id = this.$route.params.student_id
          this.$store.dispatch('student/store_emergency_contact', {
            form: this.form
          }).then(res => {
            this.wating_result = false
            this.is_active = false
          })
        }
      })
    }
  },
  created () {
    bus.$on('open_dialog_emergency_add', (payload) => {
      this.is_active = true
    })
  }
}
</script>