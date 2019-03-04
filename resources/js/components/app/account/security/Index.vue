<template>
  <v-card>
    <v-card-title>
      <h4 class="ca-typo-title-4">Security</h4>
    </v-card-title>
    <v-card-text>
      <el-form ref="form" status-icon :model="form" :rules="rules" label-position="top">
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <el-form-item label="Current password" class="ca-label" ref="current_password_item" prop="current_password">
                <el-input type="password" v-model="form.current_password" ref="current_password"></el-input>
              </el-form-item>  
            </v-flex>
            <v-flex xs12>
              <el-form-item label="New password" class="ca-label" prop="new_password">
                <el-input type="password" v-model="form.new_password"></el-input>
              </el-form-item>  
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Repeat password" class="ca-label" prop="repeat_password">
                <el-input type="password" v-model="form.repeat_password"></el-input>
              </el-form-item>  
            </v-flex>
          </v-layout>
        </v-container>
      </el-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn flat color="primary" :loading="wating_result" @click="submit()">Submit</v-btn>
    </v-card-actions>
    <v-snackbar
      v-model="snackbar_failure"
      top
      dark
      color="red darken-4"
      :timeout="30000"
    >
      Password is invaild.
      <v-btn
        color="white"
        flat
        @click="snackbar_failure = false"
      >
        Close
      </v-btn>
    </v-snackbar>
    <v-snackbar
      v-model="snackbar_success"
      top
      color="success"
      :timeout="30000"
    >
      Your password has successfully changed.
      <v-btn
        color="white"
        flat
        @click="snackbar_success = false"
      >
        Close
      </v-btn>
    </v-snackbar>
  </v-card>
</template>
<script>
export default {
  data () {
    var validate_password_confirmation = (rule, value, callback) => {
      if (value !== this.form.new_password) {
        callback(new Error())
      } else {  
        callback()  
      }
    }

    return {
      snackbar_success: false,
      snackbar_failure: false,
      wating_result: false,
      form: {
        current_password: '',
        new_password: '',
        repeat_password: ''
      },
      rules: {
        current_password: [
          { required: true, message: 'Please input current name', trigger: 'blur' }
        ],
        new_password: [
          { required: true, message: 'Please input new password', trigger: 'blur' }
        ],
        repeat_password: [
          { required: true, message: 'Please repeat password', trigger: 'blur' },
          { validator: validate_password_confirmation, message: 'Please double check if it is matched with new password', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.wating_result = true
          this.$store.dispatch('account/change_password', {
            form: this.form
          }).then(res => {
            console.log('good')
            this.wating_result = false
            this.snackbar_success = true
          }).catch(err => {
            console.log('err')
            this.wating_result = false
            this.form.current_password = ''
            this.$refs.current_password.focus()
            this.$refs.current_password_item.resetField()
            this.snackbar_failure = true
          })
        }
      })
    }
  }
}
</script>