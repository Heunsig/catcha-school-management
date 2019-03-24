<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title>
        <div class="ca-typo-title-4">Do you want to delete Receipt #{{payment.id}}?</div>
        <div>In order to verify you delete this receipt, please input <strong>Receipt #{{payment.id}}</strong> into the below text field.</div>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <el-form-item label="Verification Code" class="ca-label" prop="verification_code">
            <el-input 
              label="test"
              v-model="form.verification_code"
              placeholder="Please input verification code" 
            ></el-input>
          </el-form-item> 
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
        <v-btn 
          color="primary" 
          flat 
          @click="submit()"
          :loading="waiting_result"
        >
          Submit
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
export default {
  data () {
    var validate_verification_code_confirmation = (rule, value, callback) => {
      if (value === this.verifying_code) {
        callback()
      } else {
        callback(new Error())
      }
    }

    return {
      is_active: false,
      waiting_result: false,
      payment: {},
      verifying_code: '',
      form: {
        verification_code: ''
      },
      rules: {
        verification_code: [
          { 
            validator: validate_verification_code_confirmation, 
            message: 'The code doesn\'t match. Please check the code above again', 
            trigger: 'blur'
          }
        ]
      }
    }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data()
        this.$refs['form'].resetFields()
      }
    }
  },
  methods: {
    verify_deletion () {
      let verifying_code = 'Receipt #' + this.payment.id
      if (verifying_code === this.verification_code) {
        return true
      }

      return false
    },
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {
          this.waiting_result = true

          this.$store.dispatch('student/payment/destory', {
            payment_id: this.payment.id
          }).then(res => {
            this.waiting_result = false
            this.is_active = false
          })
        }
      })
    }
  },
  created () {
    bus.$on('open_dialog_deletion', (payload) => {
      this.is_active = true
      this.payment = payload.payment
      this.verifying_code = 'Receipt #' + this.payment.id
    })
  }
}
</script>