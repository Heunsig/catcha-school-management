<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="500">
    <v-card>
      <v-card-title>
        <!-- <span>Delete Leave Request</span> -->
        <div class="ca-typo-title-4">Do you want to delete {{leave_request.leave_type}}?</div>
        <div>In order to verify you delete this receipt, please input <strong>{{leave_request.leave_type}}</strong> into the below text field.</div>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" :rules="rules" label-position="top">
          <v-container fluid class="pa-0 ca-grid-list-1">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Verifiable Code" class="ca-label" prop="verifiable_code">
                  <el-input 
                    v-model="form.verifiable_code"
                    placeholder="Please input verifiable code" 
                  ></el-input>
                </el-form-item>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
        <v-btn 
          flat
          color="primary"
          @click="submit()"
          :loading="wating_result"
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
      if (value === this.leave_request.leave_type) {
        callback()
      } else {
        callback(new Error())
      }
    }

    return {
      wating_result: false,
      is_active: false,
      leave_request: {},
      form: {
        verifiable_code: ''
      },
      rules: {
        verifiable_code: [
          { 
            validator: validate_verification_code_confirmation, 
            message: 'The code doesn\'t match. Please check the code above again', 
            trigger: 'blur'
          }
        ]
      }
    }
  },
  computed: {
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.$refs['form'].resetFields()
        // this.reset_data()
      }
    }
  },
  methods: {
    submit () {
      this.$refs['form'].validate((valid) => {
        if (valid) {

          this.wating_result = true

          this.$store.dispatch('student/leave/destroy', {
            leave_id: this.leave_request.id
          }).then(res => {
            this.wating_result = false
            this.is_active = false

            this.open_dialog_program_attachment({
              reason: `${res.data.leave_type} (${res.data.start_date} - ${res.data.completion_date}) is removed`
            })
          })
        }
      })
    },
    open_dialog_program_attachment (payload) {
      bus.$emit('open_dialog_program_attachment', payload)
    }
  },
  created () {
    bus.$on('open_dialog_leave_deletion', (payload) => {
      this.is_active = true
      this.leave_request = payload.leave_request
    })
  }
}
</script>