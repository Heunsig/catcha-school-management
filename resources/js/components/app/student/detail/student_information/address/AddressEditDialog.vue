<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="600">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Edit {{ capitalize_first_letter(type) }} Address</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-3">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Address line 1" class="ca-label" prop="address_line1">
                  <el-input class="mb-1" v-model="form.address_line1"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Address line 2" class="ca-label">
                  <el-input class="mb-1" v-model="form.address_line2"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs6>
                <el-form-item label="City" class="ca-label" prop="city">
                  <el-input v-model="form.city"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs6>
                <el-form-item label="State" class="ca-label">
                  <el-input v-model="form.state"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Country" class="ca-label" prop="country">
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
                <el-form-item label="Postal Code" class="ca-label">
                  <el-input v-model="form.postal_code"></el-input>
                </el-form-item>
              </v-flex>
            </v-layout>
            <!-- <v-layout wrap>
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
                <el-form-item label="Postal Code" class="ca-label">
                  <el-input placeholder="Please input" v-model="form.postal_code"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
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
            </v-layout> -->
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-1" @click="is_active = false">Close</v-btn>
        <v-btn 
          flat 
          @click="submit()"
          color="primary"
          :loading="wating_result"
        >Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
import countriesMixin from '../../../../../../mixins/countries'

export default {
  mixins: [
    countriesMixin
  ],
  data () {
    return {
      is_active: false,
      address_id: null,
      wating_result: false,
      type: '',
      form: {
        address_line1: '',
        address_line2: '',
        city: '',
        state: '',
        postal_code: '',
        country: '',
        type: ''
      },
      rules: {
        address_line1: [
          { required: true, message: 'Please input address line 1', trigger: 'blur' },
        ],
        city: [
          { required: true, message: 'Please input city', trigger: 'blur' },
        ],
        country: [
          { required: true, message: 'Please select country', trigger: 'change' },
        ]
      }
    }
  },
  watch: {
    is_active (n_val) {
      if(!n_val) {
        this.$refs['form'].resetFields()
      }
    }
  },
  methods: {
    submit () {
      this.form.student_id = this.$route.params.student_id
      this.$store.dispatch('student/update_address', {
        address_id: this.address_id,
        form: this.form
      }).then(res => {
        this.is_active = false
      })
    }
  },
  created () {
    bus.$on('oepn_dialog_address_edit', (payload) => {
      this.is_active = true
      this.address_id = payload.address_id
      Object.assign(this.form, payload.form)
      this.type = payload.form.type
    })
  }
}
</script>