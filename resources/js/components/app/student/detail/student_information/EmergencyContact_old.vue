<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-3">Emergency Contact</div>
      <v-spacer></v-spacer>
      <v-btn 
        icon
        @click="dialog = true"
      >
        <v-icon small>edit</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-2">
        <v-layout wrap>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Name</div>
              <div class="ca-label-content" v-if="emergency_contact.name">
                <span>{{ emergency_contact.name }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Relationship</div>
              <div class="ca-label-content" v-if="emergency_contact.relationship">
                <span>{{ emergency_contact.relationship }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Contact Number</div>
              <div class="ca-label-content" v-if="emergency_contact.number">
                <!-- <span class="flag-icon" :class="get_flag(get_country_as_dial_code(emergency_contact.country_code).code)"></span> -->
                <v-tooltip bottom>
                  <span slot="activator" class="flag-icon mr-1" :class="get_flag(get_country_as_dial_code(emergency_contact.country_code).code)"></span>
                  <span>{{ get_country_as_dial_code(emergency_contact.country_code).name }}</span>
                </v-tooltip>
                <span>+{{ emergency_contact.country_code }}</span>
                <span>{{ emergency_contact.number }} ({{ capitalize_first_letter(emergency_contact.type) }})</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Email</div>
              <div class="ca-label-content" v-if="emergency_contact.email">
                <span>{{ emergency_contact.email }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label-title ca-title-5 font-weight-bold">Address</div>
            <template>
              <div class="ca-label-content" v-if="emergency_contact.address_line1">{{ emergency_contact.address_line1 }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </template>
            <div class="ca-label-content" v-if="emergency_contact.address_line2">{{ emergency_contact.address_line2 }}</div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">City</div>
              <div class="ca-label-content" v-if="emergency_contact.city">{{ emergency_contact.city }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">State</div>
              <div class="ca-label-content" v-if="emergency_contact.state">{{ emergency_contact.state }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Country</div>
              <div class="ca-label-content" v-if="emergency_contact.country">{{ get_country(emergency_contact.country).name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Postal Code</div>
              <div class="ca-label-content" v-if="emergency_contact.postal_code">{{ emergency_contact.postal_code }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <v-dialog v-model="dialog" persistent scrollable max-width="700">
      <v-card>
        <v-card-title></v-card-title>
        <v-card-text>
          <el-form ref="form" :model="form" label-position="top">
            <div>
              <h4 class="ca-typo-title-4">Basic Information</h4>
              <v-container fluid class="pa-0 ca-grid-list-2">
                <v-layout wrap>
                  <v-flex xs6>
                    <el-form-item label="Name" class="ca-label">
                      <el-input placeholder="Please input" v-model="form.name"></el-input>
                    </el-form-item>
                  </v-flex>
                  <v-flex xs6>
                    <el-form-item label="Relationship" class="ca-label">
                      <el-select 
                        v-model="form.relationship"
                        allow-create
                        filterable
                        placeholder="Select"
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
                        placeholder="Please input"
                        class="mt-2"
                        v-model="form.etc"
                        v-if="form.relationship === 'ETC'"
                      ></el-input>
                    </el-form-item>
                  </v-flex>
                </v-layout>
              </v-container>
            </div>
            <div>
              <h4 class="ca-typo-title-4">Contact</h4>
              <v-container fluid class="pa-0 ca-grid-list-2">
                <v-layout wrap>
                  <v-flex xs12>
                    <el-form-item label="Type" class="ca-label">
                      <el-select 
                        v-model="form.type" 
                        filterable
                        placeholder="Select"
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
                        placeholder="Select"
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
                      <el-input placeholder="Please input" v-model="form.number">
                        <template slot="prepend">
                          <span v-if="form.country_code">+{{ form.country_code }}</span>
                        </template>
                      </el-input>
                    </el-form-item>
                  </v-flex>
                  <v-flex xs12>
                    <el-form-item label="Email" class="ca-label">
                      <el-input placeholder="Please input" v-model="form.email"></el-input>
                    </el-form-item>
                  </v-flex>
                </v-layout>
              </v-container>
            </div>
            <div>
              <h4 class="ca-typo-title-4">Address</h4>
              <v-container fluid class="pa-0 ca-grid-list-2">
                <v-layout wrap>
                  <v-flex xs12>
                    <el-form-item label="Address" class="ca-label">
                      <el-input placeholder="Please input" class="mb-1" v-model="form.address_line1"></el-input>
                      <el-input placeholder="Please input" v-model="form.address_line2"></el-input>
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
                        placeholder="Select"
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
                      <el-input placeholder="Please input" v-model="form.postal_code"></el-input>
                    </el-form-item>
                  </v-flex>
                </v-layout>
              </v-container>
            </div>
          </el-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat @click="dialog = false">Disagree</v-btn>
          <v-btn flat @click="submit_update()">Agree</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
import countriesMixin from '../../../../../mixins/countries'
export default {
  mixins: [
    countriesMixin
  ],
  data () {
    return {
      dialog: false,
      relationship_options: ['Father', 'Mother', 'Friend', 'ETC'],
      types: ['Cellphone', 'Phone', 'Fax'],
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
      }
    }
  },
  computed: {
    emergency_contact () {
      return this.$store.getters['student/emergency_contact']
    }
  },
  methods: {
    get_flag (code) {
      return code ? 'flag-icon-' + code.toLowerCase():null
    },
    submit_update () {
      this.form.student_id = this.$route.params.student_id
      this.$store.dispatch('student/store_emergency_contact', {
        form: this.form
      }).then(res => {
        this.dialog = false
      })
    }
  }
}
</script>
<style scoped>
  .el-form-item {
    margin-bottom: 0px!important;
  }
</style>