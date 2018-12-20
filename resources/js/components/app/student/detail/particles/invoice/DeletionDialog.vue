<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title>
        <div class="ca-typo-title-4">Do you want to delete Receipt #{{invoice.id}}?</div>
        <div>In order to verify you delete this receipt, please input <strong>Receipt #{{invoice.id}}</strong> into the below text field.</div>
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
    invoice: {},
    verification_code: '',
    verification_error: '',
    wating_result: false
  }),
  methods: {
    verify_deletion () {
      let verifying_code = 'Receipt #' + this.invoice.id
      if (verifying_code === this.verification_code) {
        return true
      }

      return false
    },
    submit () {
      if (this.verify_deletion()) {
        this.wating_result = true

        // let id = payload.invoice_id
        // return new Promise((resolve, reject) => {
          this.$axios.delete(`/invoice/${this.invoice.id}`).then(res => {
            this.$emit('del_invoice', {
              new: res,
              old: this.invoice
            })
            this.wating_result = false
            this.is_active = false
            // console.log('res', res)
            // resolve(res.data)
          })
        // })
        // this.$store.dispatch('invoice/del_invoice', {
        //   invoice_id: this.invoice.id
        // }).then(res => {
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
      this.invoice = payload.invoice
    })
  }
}
</script>