<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-2">Invoice</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="open_dialog_invoice_addition()">Issue Receipt</v-btn>
    </v-card-title>
    <v-card-text>
      <div class="ca-filter-box">
        <v-checkbox v-model="filtered_by" color="green lighten-1" class="__check-box" hide-details label="Paid" value="Paid"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="amber darken-1" class="__check-box" hide-details label="Waiting" value="Waiting"></v-checkbox>
        <v-checkbox v-model="filtered_by" color="grey darken-1" class="__check-box" hide-details label="Canceled" value="Canceled"></v-checkbox>
        <!-- <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Refunded" value="Refunded"></v-checkbox> -->
        <v-checkbox v-model="filtered_by" class="__check-box" hide-details label="Deleted" value="Deleted"></v-checkbox>
      </div>
      <v-container fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12 
            v-for="invoice in filtered_invoices" 
            :key="invoice.id"
          >
            <invoice
              :invoice="invoice"
            ></invoice>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <new-invoice-addition-dialog
      :payment_methods="payment_methods"
      :products="products"
      @add_invoice="add_invoice($event)"
    ></new-invoice-addition-dialog>
    
    <status-change-dialog
      @change_status="change_status($event)"
    >
    </status-change-dialog>

    <refund-dialog
      @refund="refund($event)"
    >
    </refund-dialog>

    <deletion-dialog
      @del_invoice="del_invoice($event)"
    ></deletion-dialog>

  </v-card>
</template>
<script>
import Vue from 'vue'

import bus from 'bus'
import Invoice from './particles/invoice/Invoice'
import NewInvoiceAdditionDialog from './particles/invoice/NewInvoiceAdditionDialog'
import StatusChangeDialog from './particles/invoice/StatusChangeDialog'
import RefundDialog from './particles/invoice/RefundDialog'
import DeletionDialog from './particles/invoice/DeletionDialog'


export default {
  components: {
    Invoice,
    NewInvoiceAdditionDialog,
    StatusChangeDialog,
    RefundDialog,
    DeletionDialog
  },
  data: () => ({
    payment_methods: [],
    products: [],
    invoices: [],
    filtered_by: [
      'Paid',
      'Waiting',
      'Canceled'
    ],
  }),
  computed: {
    filtered_invoices () {
      let $this = this
      let filtered_data = []
      if (this.filtered_by.indexOf('Deleted') > -1 ) { 
        filtered_data = this.invoices
      } else {
        filtered_data = this._.filter(this.invoices, ['deleted_at', null])
      }

      return this._.filter(filtered_data, function(o) {
        return $this.filtered_by.indexOf(o.status) > -1 ? true : false
      })
    }
  },
  methods: {
    open_dialog_invoice_addition () {
      bus.$emit('open_dialog_invoice_addition')
    },
    add_invoice (obj) {
      this.invoices.push(obj)
    },
    change_status (obj) {
      console.log('new', obj.new)
      let index = this.invoices.indexOf(obj.old)
      this.$set(this.invoices, index, obj.new)
    },
    refund (obj) {
      let index = this.invoices.indexOf(obj.old)
      this.$set(this.invoices, index, obj.new)
    },
    del_invoice (obj) {
      let index = this.invoices.indexOf(obj.old)
      this.$set(this.invoices, index, obj.new)
    }
  },
  created () {
    this.$axios.get(`/payment_method`).then(res => {
      this.payment_methods = res.data
    })

    this.$axios.get('/product').then(res => {
      this.products = res.data
      console.log('products', res.data)
    })

    this.$axios.get('/invoice').then(res => {
      this.invoices = res.data
      // console.log('invoice', res.data)
    })
  }
}
</script>