<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-3">Contact</div>
      <v-spacer></v-spacer>
      <v-btn icon @click="dialog_add = true">
        <v-icon small color="grey darken-1">add</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <table class="insty-table">
        <thead>
          <tr>
            <th class="text-xs-center">Type</th>
            <th class="text-xs-left" style="width:200px;">Country Code</th>
            <th class="text-xs-left" style="width:auto;">Contact Number</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="cellphone in cellphones"
            :key="cellphone.id"
          >
            <td class="text-xs-center">{{ capitalize_first_letter(cellphone.type) }}</td>
            <td>
              <div class="ca-label-content" v-if="cellphone.country_code">
                <v-tooltip bottom>
                  <span slot="activator" class="flag-icon mr-1" :class="get_flag(get_country_as_dial_code(cellphone.country_code).code)"></span>
                  <span>{{ get_country_as_dial_code(cellphone.country_code).name }}</span>
                </v-tooltip>
                <span>+{{ get_country_as_dial_code(cellphone.country_code).dial_code }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </td>
            <td>
              <div class="ca-label-content" v-if="cellphone.country_code">
                <span>{{ cellphone.number }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </td>
            <td>
              <v-icon 
                small 
                class="ca-cursor-pointer insty-hover-close"
                color="grey lignten-5"
                @click="remove_number(cellphone)"
              >
                close
              </v-icon>
            </td>
          </tr>
        </tbody>
      </table>
    </v-card-text>
    <v-dialog v-model="dialog_remove" persistent max-width="400">
      <v-card>
        <v-card-text>
          Do you want to remove <strong>+{{ selected_contact.country_code }} {{ selected_contact.number }}</strong> ?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat @click="dialog_remove = false">Disagree</v-btn>
          <v-btn flat @click="submit_remove()">Agree</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialog_add" persistent max-width="600">
      <v-card>
        <v-card-title>
          <h4 class="ca-typo-title-4">Add Contact</h4>
        </v-card-title>  
        <v-card-text>
          <el-form ref="form" :model="form" :rules="rules" label-position="top">
            <v-container fluid class="pa-0 ca-grid-list-2">
              <v-layout wrap>
                <v-flex xs12>
                  <el-form-item label="Type" class="ca-label" prop="type">
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
                  <el-form-item label="Country Dial Code" class="ca-label" prop="country_code">
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
                  <el-form-item label="Contact Number" class="ca-label" prop="number">
                    <el-input placeholder="Please input" v-model="form.number">
                      <template slot="prepend">
                        <span v-if="form.country_code">+{{ form.country_code }}</span>
                      </template>
                    </el-input>
                  </el-form-item>
                </v-flex>
              </v-layout>
            </v-container>
          </el-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat color="grey darken-2" @click="dialog_add = false">Disagree</v-btn>
          <v-btn 
            flat
            @click="submit_store()"
            color="primary"
            :loading="wating_result"
          >Agree</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
import contriesMixin from '../../../../../mixins/countries'
export default {
  mixins: [
    contriesMixin
  ],
  data () {
    return {
      dialog_remove: false,
      dialog_add: false,
      wating_result: false,
      types: ['Cellphone', 'Phone', 'Fax'],
      selected_contact: {},
      form: {
        student_id: null,
        country_code: '',
        number: '',
        type: ''
      },
      rules: {
        type: [
          { required: true, message: 'Please select type', trigger: 'change' },
        ],
        country_code: [
          { required: true, message: 'Please select country', trigger: 'change' },
        ],
        number: [
          { required: true, message: 'Please input number', trigger: 'blur' },
        ]
      }
    }
  },
  computed: {
    cellphones () {
      return this.$store.getters['student/cellphones']
    },
  },
  watch: {
    dialog_add (n_val) {
      if(!n_val) {
        this.$refs['form'].resetFields()
      }
    }
  },
  methods: {
    get_flag (code) {
      if (code) {
        return 'flag-icon-' + code.toLowerCase()
      } else {
        return ''
      }
    },
    remove_number (contact) {
      this.selected_contact = contact
      this.dialog_remove = true
    },
    submit_remove () {
      this.$store.dispatch('student/remove_contact',{
        contact_id: this.selected_contact.id
      }).then(res => {
        this.dialog_remove = false
      })
    },
    submit_store () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.form.student_id = this.$route.params.student_id
          this.$store.dispatch('student/store_contact', {
            form: this.form
          }).then(res => {
            this.wating_result = false
            this.dialog_add = false
          })
        }
      });
      
    }
  },
  created () {
    this.$store.dispatch('student/get_contact', {
      student_id: this.$route.params.student_id
    })
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .insty-table thead tr th {
    color: #555555;
    border-bottom: 1px solid #cccccc;
  }

  .insty-table th {
    font-weight: 300;
  }

  .insty-table th, .insty-table td {
    padding: 10px 0;
  }

  .insty-hover-close:hover {
    color: #000!important;
  }
</style>