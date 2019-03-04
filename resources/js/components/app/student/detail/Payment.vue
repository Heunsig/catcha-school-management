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
        <!-- <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Refunded" value="Refunded"></v-checkbox> -->
        <!-- <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Deleted" value="Deleted"></v-checkbox> -->
      </div>
      <template v-if="loading">
        <div class="ca-loading-box">
          <v-progress-circular
            indeterminate
            color="primary"
          ></v-progress-circular> 
        </div>
      </template>
      <template v-else>
        <template v-if="_.isEmpty(filtered_payments)">
          <div class="ca-nodata-box">
            <div class="ca-nodata-box__message">
              <v-icon>sentiment_very_dissatisfied</v-icon>
              <div class="message">Nothing to see here</div>
            </div>
          </div>
        </template>
        <template v-else>
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
      </template>
      <!-- <template v-if="!_.isEmpty(filtered_payments)">
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
      </template> -->
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
import Payment from './payment/Payment'
import NewPaymentAdditionDialog from './payment/NewPaymentAdditionDialog'
import StatusChangeDialog from './payment/StatusChangeDialog'
import RefundDialog from './payment/RefundDialog'
import DeletionDialog from './payment/DeletionDialog'

export default {
  components: {
    Payment,
    NewPaymentAdditionDialog,
    StatusChangeDialog,
    RefundDialog,
    DeletionDialog
  },
  data: () => ({
    loading: false,
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
    this.loading = true
    this.$store.dispatch('product/get_products')
    this.$store.dispatch('payment/init_data', {
      student_id: this.$route.params.student_id
    }).then(res => {
      this.loading = false
    })
  }
}
</script>