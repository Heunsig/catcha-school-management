<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Payment</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="open_dialog_payment_addition()">Issue Receipt</v-btn>
    </v-card-title>
    <v-card-text>
      <div class="ca-filter-box">
        <v-checkbox v-model="filtered_by" color="green lighten-1" class="__check-box" hide-details label="Paid" value="Paid"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="amber darken-1" class="__check-box" hide-details label="Waiting" value="Waiting"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="grey darken-1" class="__check-box" hide-details label="Canceled" value="Canceled"></v-checkbox>
      </div>
      <PaymentBoxSection :filtered_by="filtered_by"></PaymentBoxSection>
    </v-card-text>

    <Dialog_AddNewPayment></Dialog_AddNewPayment>
    <Dialog_ChangeStatus></Dialog_ChangeStatus>
    <Dialog_DeletePayment></Dialog_DeletePayment>
  </v-card>
</template>
<script>
import bus from 'bus'

import PaymentBoxSection from './payment_box_section/Index'
import Dialog_AddNewPayment from './dialogs/Dialog_AddNewPayment'
import Dialog_ChangeStatus from './dialogs/Dialog_ChangeStatus'
import Dialog_DeletePayment from './dialogs/Dialog_DeletePayment'

export default {
  components: {
    PaymentBoxSection,
    Dialog_AddNewPayment,
    Dialog_ChangeStatus,
    Dialog_DeletePayment
  },
  data: () => ({
    filtered_by: [
      'Paid',
      'Waiting',
      'Canceled'
    ],
  }),
  methods: {
    open_dialog_payment_addition () {
      bus.$emit('open_dialog_payment_addition')
    },
  },
  created () {
    this.$store.dispatch('product/get_products')
  }
}
</script>