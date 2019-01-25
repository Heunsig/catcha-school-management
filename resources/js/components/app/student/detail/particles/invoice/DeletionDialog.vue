<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title>
        <div class="ca-typo-title-4">Do you want to delete Receipt #{{payment.id}}?</div>
        <div>In order to verify you delete this receipt, please input <strong>Receipt #{{payment.id}}</strong> into the below text field.</div>
      </v-card-title>
      <v-card-text>
        <span class="red--text">{{verification_error}}</span>
        <v-text-field
          v-model="verification_code"
          label="Verification Code"
        >
        </v-text-field>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="green darken-1" flat @click="is_active = false">Disagree</v-btn>
        <v-btn 
          color="green darken-1" 
          flat 
          @click="submit()"
          :loading="wating_result"
        >
          Agree
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
    verification_code: '',
    verification_error: ''
  }),
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset_data()
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
      if (this.verify_deletion()) {
        this.wating_result = true

        this.$store.dispatch('payment/destory', {
          payment_id: this.payment.id
        }).then(res => {
          this.wating_result = false
          this.is_active = false
        })

        // this.$axios.delete(`/invoice/${this.invoice.id}`).then(res => {
        //   this.$emit('del_invoice', {
        //     new: res,
        //     old: this.invoice
        //   })
        //   this.wating_result = false
        //   this.is_active = false
        // })
      } else {
        this.verification_error = 'Please wrtie down the above bold word'
      }
    }
  },
  created () {
    bus.$on('open_dialog_deletion', (payload) => {
      this.is_active = true
      this.payment = payload.payment
    })
  }
}
</script>