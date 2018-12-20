<template>
  <v-dialog v-model="is_active" persistent max-width="400">
    <v-card>
      <v-card-title class="ca-typo-title-4">Do you want to change status?</v-card-title>
      <v-card-text>
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <v-select
                v-model="status"
                :items="STATUS_ITEMS"
              >
              </v-select>
            </v-flex>
          </v-layout>
        </v-container>          
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
    status: '',
    invoice: {},
    wating_result: false
  }),
  methods: {
    submit () {
      this.wating_result = true
      this.$axios.post(`/invoice/${this.invoice.id}/change_status`, {
        status: this.status
      }).then(res => {
        // console.log('res', res)
        this.$emit('change_status', {
          new: res.data,
          old: this.invoice
        })
        this.is_active = false
        this.wating_result = false
      })

      // this.$store.dispatch('invoice/change_status',{
      //   invoice_id: this.invoice.id,
      //   status: this.status
      // }).then(res => {
      //   this.$emit('change_status', {
      //     new: res,
      //     old: this.invoice
      //   })

      //   this.is_active = false
      //   this.wating_result = false
      // })
    }
  },
  created () {
    bus.$on('open_dialog_status_change', (payload) => {
      this.is_active = true
      this.invoice = payload.invoice
      this.status = payload.invoice.status
    })
  }
}
</script>