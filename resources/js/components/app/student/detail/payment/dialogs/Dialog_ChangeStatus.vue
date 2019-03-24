<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">Change Status</h4>
      </v-card-title>
      <v-card-text>
        <el-form ref="form" :model="form" label-position="top">
          <v-container fluid class="pa-0">
            <v-layout wrap>
              <v-flex xs12>
                <el-form-item label="Status" class="ca-label">
                  <el-select 
                    v-model="form.status" 
                    placeholder="Select"
                    class="ca-block"
                  >
                    <el-option
                      v-for="item in STATUS_ITEMS"
                      :key="item"
                      :label="item"
                      :value="item"
                    >
                    </el-option>
                  </el-select>
                </el-form-item>
              </v-flex>
            </v-layout>
          </v-container>
        </el-form>      
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
        <v-btn 
          color="primary"
          flat 
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
  data: () => ({
    is_active: false,
    wating_result: false,
    payment: {},
    form: {
      status: ''
    }
  }),
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data()
      }
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$store.dispatch('student/payment/change_status', {
        payment_id: this.payment.id,
        form: this.form
      }).then(res => {
        console.log('aaaa')
        this.wating_result = false
        this.is_active = false
      })
    }
  },
  created () {
    bus.$on('open_dialog_status_change', (payload) => {
      this.is_active = true
      this.payment = payload.payment
      this.form.status = payload.payment.status
    })
  }
}
</script>