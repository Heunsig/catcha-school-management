<template>
  <v-dialog v-model="is_active" persistent max-width="700">
    <v-card>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-2">
            <v-layout wrap>
              <v-flex xs6>
                <el-form-item label="Type" class="ca-label">
                  <el-select 
                    v-model="form.type" 
                    filterable
                    placeholder="Select"
                    class="ca-block"
                  >
                    <el-option
                      v-for="option in type_options"
                      :key="option.value"
                      :label="option.key"
                      :value="option.value"
                    >
                    </el-option>
                  </el-select>
                </el-form-item>
              </v-flex>
              <v-flex xs6>
                <el-form-item label="Type" class="ca-label">
                  <el-select 
                    v-model="form.status" 
                    filterable
                    placeholder="Select"
                    class="ca-block"
                  >
                    <el-option
                      v-for="option in status_options"
                      :key="option.value"
                      :label="option.key"
                      :value="option.value"
                    >
                    </el-option>
                  </el-select>
                </el-form-item>
              </v-flex>
              <v-flex xs4>
                <el-form-item label="First Name" class="ca-label">
                  <el-input v-model="form.first_name"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs4>
                <el-form-item label="Middle Name" class="ca-label">
                  <el-input v-model="form.middle_name"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs4>
                <el-form-item label="Last Name" class="ca-label">
                  <el-input v-model="form.last_name"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Nickname" class="ca-label">
                  <el-input v-model="form.nickname"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Email" class="ca-label">
                  <el-input v-model="form.email"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Sex" class="ca-label">
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
              <v-flex xs12>
                <el-form-item label="Date of birth" class="ca-label">
                  <el-input v-model="form.date_of_birth"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Country of citizenship" class="ca-label">
                  <el-input v-model="form.country_of_citizenship"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Country of birth" class="ca-label">
                  <el-input v-model="form.country_of_birth"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="City of birth" class="ca-label">
                  <el-input v-model="form.city_of_birth"></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Note" class="ca-label">
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
import countries from '../../../../../../mixins/countries'

export default {
  mixins: [
    countries
  ],
  data () {
    return {
      is_active: false,
      status_options: [],
      type_options: [],
      sex_options: ['Male', 'Female'],
      form: {
        type: '',
        status: '',
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
      }
    }
  },
  methods: {
    submit () {
      
    }
  },
  created () {
    bus.$on('open_dialog_basic_information_addition', payload => {
      this.is_active = true
    })

    this.$axios.get('/student/register').then(res => {
      this.status_options = res.data.status_options
      this.type_options = res.data.type_options
    })
  }
}
</script>