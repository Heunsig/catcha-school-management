<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Invoice</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="open_dialog_payment_addition()">Issue Receipt</v-btn>
    </v-card-title>
    <v-card-text>
      <div class="ca-filter-box">
        <v-checkbox v-model="filtered_by" color="green lighten-1" class="__check-box" hide-details label="Paid" value="Paid"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="amber darken-1" class="__check-box" hide-details label="Waiting" value="Waiting"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="grey darken-1" class="__check-box" hide-details label="Canceled" value="Canceled"></v-checkbox>
        <!-- <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Refunded" value="Refunded"></v-checkbox> -->
        <!-- <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Deleted" value="Deleted"></v-checkbox> -->
      </div>
      <template v-if="!_.isEmpty(filtered_payments)">
        <v-container fluid class="pa-0 ca-grid-list-4-y">
          <v-layout wrap>
            <v-flex xs12 
              v-for="payment in filtered_payments" 
              :key="payment.id"
            >
              <payment
                :payment="payment"
              ></payment>
            </v-flex>
          </v-layout>
        </v-container>
      </template>
      <template v-else>
        <div class="text-xs-center ca-typo-5 ca-typo-style-blank">
          There are no payments
        </div>
      </template>
    </v-card-text>
    <NewPaymentAdditionDialog></NewPaymentAdditionDialog>
    <!-- <new-payment-addition-dialog
      :payment_methods="payment_methods"
      :products="products"
      @add_payment="add_payment($event)"
    ></new-payment-addition-dialog> -->
    
    <status-change-dialog
      @change_status="change_status($event)"
    >
    </status-change-dialog>

    <refund-dialog
      @refund="refund($event)"
    >
    </refund-dialog>

    <deletion-dialog
      @del_payment="del_payment($event)"
    ></deletion-dialog>

  </v-card>
</template>
<script>
import Vue from 'vue'

import bus from 'bus'
import Payment from './particles/invoice/Payment'
import NewPaymentAdditionDialog from './particles/invoice/NewPaymentAdditionDialog'
import StatusChangeDialog from './particles/invoice/StatusChangeDialog'
import RefundDialog from './particles/invoice/RefundDialog'
import DeletionDialog from './particles/invoice/DeletionDialog'


export default {
  components: {
    Payment,
    NewPaymentAdditionDialog,
    StatusChangeDialog,
    RefundDialog,
    DeletionDialog
  },
  data: () => ({
    filtered_by: [
      'Paid',
      'Waiting',
      'Canceled'
    ],
  }),
  computed: {
    payments () {
      return this.$store.getters['payment/payments']
    },
    filtered_payments () {
      let $this = this
      let filtered_data = this._.reverse(this._.clone(this.payments))

      if (this.filtered_by.indexOf('Deleted') < 0 ) { 
        filtered_data = this._.filter(filtered_data, function (o) {
          return o.administration.deleted_at === null
        })
      }

      return this._.filter(filtered_data, function(o) {
        return $this.filtered_by.indexOf(o.status) > -1 ? true : false
      })
    },

  },
  methods: {
    open_dialog_payment_addition () {
      bus.$emit('open_dialog_payment_addition')
    },
    change_status (obj) {
      console.log('new', obj.new)
      let index = this.payments.indexOf(obj.old)
      this.$set(this.payments, index, obj.new)
    },
    refund (obj) {
      let index = this.payments.indexOf(obj.old)
      this.$set(this.payments, index, obj.new)
    },
    del_payment (obj) {
      let index = this.payments.indexOf(obj.old)
      this.$set(this.payments, index, obj.new)
    }
  },
  created () {
    this.$store.dispatch('product/get_products')
    this.$store.dispatch('payment/init_data', this.$route.params.student_id)
  }
}
</script>