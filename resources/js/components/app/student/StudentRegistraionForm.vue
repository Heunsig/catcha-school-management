<template>
  <el-form ref="form" :model="form" :rules="rules" label-position="top">
    <v-card>
      <v-card-text>
        <v-container fluid>
          <v-layout wrap>
            <v-flex xs12>
              <el-form-item label="Email" class="ca-label" prop="email">
                <el-input v-model="form.email"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Password" class="ca-label" prop="password">
                <el-input type="password" v-model="form.password" autocomplete="off"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Password Confirmation" class="ca-label" prop="password_confirmation">
                <el-input type="password" v-model="form.password_confirmation" autocomplete="off"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Status" class="ca-label" prop="status_id">
                <el-select v-model="form.status_id" placeholder="Select" class="ca-block">
                  <el-option
                    v-for="item in status_options"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id">
                  </el-option>
                </el-select>
              </el-form-item>
            </v-flex>
            <v-flex xs4>
              <el-form-item label="First Nme" class="ca-label" prop="first_name">
                <el-input v-model="form.first_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs4>
              <el-form-item label="Middle Nme" class="ca-label">
                <el-input v-model="form.middle_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs4>
              <el-form-item label="Last Nme" class="ca-label">
                <el-input v-model="form.last_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Nickname" class="ca-label">
                <el-input v-model="form.nickname"></el-input>
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
            <v-flex xs12>
              <v-card class="elevation-0 transparent">
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="clear()">clear</v-btn>
                  <v-btn 
                    @click="submit()" 
                    color="primary"
                    :loading="wating_result"
                  >
                    Submit
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
    <v-snackbar
      v-model="snackbar"
      top
      :timeout="3000"
    >
      <a @click="$router.push({name: 'student.basic_information', params:{student_id: created_student_id}})">{{ created_email }}</a> has been created.
      <v-btn
        color="pink"
        flat
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
  </el-form>
</template>
<script>
export default {
  data () {
    var validate_password_confirmation = (rule, value, callback) => {
      if (value !== this.form.password) {
        callback(new Error())
      } else {
        callback()  
      }
    }

    return {
      created_email: '',
      created_student_id: null,
      snackbar: false,
      wating_result: false,
      form: {
        email: '',
        password: '',
        password_confirmation: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        nickname: '',
        status_id: '',
        note: '',
      },
      status_options: [],
      rules: {
        email: [
          { required: true, message: 'Please input email', trigger: 'blur' }
        ],
        password: [
          { required: true, message: 'Please input password', trigger: 'blur' },
        ],
        password_confirmation: [
          { required: true, message: 'Please input password confirmation', trigger: 'blur' },
          { validator: validate_password_confirmation, message: 'Passwords don\' match Please check password again', trigger: 'blur' }
        ],
        first_name: [
          { required: true, message: 'Please input first name', trigger: 'blur' },
        ],
        status_id: [
          { required: true, message: 'Please select status', trigger: 'change' },
        ]
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.$axios.post(`/student`, this.form).then(res => {
            this.created_email = this.form.email
            this.created_student_id = res.data.student_id
            this.snackbar = true
            this.wating_result = false
            this.clear()
            console.log('res', res.data)
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
      this.status_options = res.data.student_status_options
    })
  }
}
</script>