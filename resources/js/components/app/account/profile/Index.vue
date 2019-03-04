<template>
  <v-card>
    <v-card-title>
      <h4 class="ca-typo-title-4">Profile</h4>
    </v-card-title>
    <v-card-text>
      <el-form ref="form" :model="form" :rules="rules" label-position="top">
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <el-form-item label="First name" class="ca-label" prop="first_name">
                <el-input v-model="form.first_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs6>
              <el-form-item label="Middle name" class="ca-label">
                <el-input v-model="form.middle_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs6>
              <el-form-item label="Last name" class="ca-label">
                <el-input v-model="form.last_name"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Email" class="ca-label" prop="email">
                <el-input v-model="form.email" readonly></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Nickname" class="ca-label">
                <el-input v-model="form.nickname"></el-input>
              </el-form-item>
            </v-flex>
            <v-flex xs12>
              <el-form-item label="Note" class="ca-label">
                <el-input v-model="form.note"></el-input>
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
      v-model="snackbar"
      top
      color="success"
      :timeout="30000"
    >
      Your profile has successfully updated.
      <v-btn
        color="white"
        flat
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
  </v-card>
</template>
<script>
export default {
  data () {
    return {
      snackbar: false,
      wating_result: false,
      form: {
        first_name: '',
        middle_name: '',
        last_name: '',
        email: '',
        // password: '',
        nickname: '',
        note: ''
      },
      rules: {
        first_name: [
          { required: true, message: 'Please input first name', trigger: 'blur' }
        ],
        // email: [
        //   { required: true, message: 'Please input email', trigger: 'blur' },
        // ]
      }
    }
  },
  computed: {
    user () {
      return this.$store.getters['account/user']
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.$store.dispatch('account/update_profile', {
            form: this.form
          }).then(res => {
            this.wating_result = false
            this.snackbar = true
          })
        }
      })
    }
  },
  created () {
    this.form.first_name = this.user.first_name
    this.form.middle_name = this.user.middle_name
    this.form.last_name = this.user.last_name
    this.form.email = this.user.email
    this.form.nickname = this.user.nickname
    this.form.note = this.user.note
  }
}
</script>