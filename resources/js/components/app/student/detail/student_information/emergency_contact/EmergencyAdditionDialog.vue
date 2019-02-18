<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="700">
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
        <v-btn flat @click="is_active = false">Disagree</v-btn>
        <v-btn flat @click="submit()">Agree</v-btn>
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
  methods: {
    submit () {
      this.form.student_id = this.$route.params.student_id
      this.$store.dispatch('student/store_emergency_contact', {
        form: this.form
      }).then(res => {
        this.is_active = false
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