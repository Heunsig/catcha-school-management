<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1100">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Issue New Receipt
        <v-spacer></v-spacer>
        <div>
          <strong>Total:</strong>
          <span>{{ $account.formatMoney(total) }}</span>
        </div>
      </v-card-title>
      <v-card-text class="grey lighten-4">
        <v-container fluid grid-list-lg class="pa-0">
          <v-layout wrap row>
            <v-flex xs5>
              <v-container fluid class="pa-0">
                <v-layout wrap>
                  <v-flex xs12>
                    <v-card>
                      <v-card-title>
                        <div class="ca-typo-title-5">Payment Information</div>
                      </v-card-title>
                      <v-card-text>
                        <!-- Payment Status Component-->
                        <payment-status-form
                          :status.sync="status"
                        >
                        </payment-status-form>
                        <!-- END Payment Status Component-->
                        
                        <!-- Payment Method Component-->
                        <payment-method-form
                          :payment_methods="payment_methods"
                          :method_key.sync="payment_method.method_key"
                          :detail.sync="payment_method.detail"
                        ></payment-method-form>
                        <!-- END Payment Method Component-->
                        
                        <!-- Payment Note Component-->
                        <payment-note-form
                          :note.sync="note"
                        >
                        </payment-note-form>
                        <!-- END Payment Note Component-->
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
            <v-flex xs7>
              <v-container fluid class="pa-0">
                <v-layout wrap>
                  <v-flex xs12 
                    v-for="(invoice_item, i) in invoice_items"
                    :key="'in_'+i"
                  >
                    <invoice-item-form
                      :products="products"
                      :product.sync="invoice_item.product_id"
                      :start_date.sync="invoice_item.start_date"
                      :completion_date.sync="invoice_item.completion_date"
                      :price.sync="invoice_item.price"
                      :quantity.sync="invoice_item.quantity"
                      :note.sync="invoice_item.note"
                      @remove="remove(invoice_item)"
                    ></invoice-item-form>
                  </v-flex>
                  <v-flex xs12>
                    <v-btn 
                      color="primary"
                      block
                      @click="add_item()"
                    >
                      Add Item
                    </v-btn>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions class="primary">
        <v-spacer></v-spacer>
        <v-btn color="white" flat @click="is_active = false">Disagree</v-btn>
        <v-btn color="white" flat @click="submit()">Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'

import PaymentMethodForm from './invoice_addition_form/PaymentMethodForm'
import PaymentStatusForm from './invoice_addition_form/PaymentStatusForm'
import PaymentNoteForm from './invoice_addition_form/PaymentNoteForm'
import InvoiceItemForm from './invoice_addition_form/InvoiceItemForm'

export default {
  props: {
    payment_methods: Array,
    products: Array
  },
  components: {
    PaymentMethodForm,
    PaymentStatusForm,
    PaymentNoteForm,
    InvoiceItemForm
  },
  data: () => ({
    is_active: false,
    total: 0,
    status: '',
    note: '',
    payment_date: '',
    payment_method: {
      method_key: null,
      detail: {}
    },
    invoice_items: []
  }),
  methods: {
    submit () {
      console.log('pament_method', this.payment_method)
      this.$axios.post(`/invoice`, {
        student_id: this.$route.params.student_id,
        status: this.status,
        note: this.note,
        payment_method: this.payment_method,
        invoice_items: this.invoice_items
      }).then(res => {
        console.log('res', res)
      })
    },
    add_item () {
      this.invoice_items.push({
        product_id: null,
        start_date: '',
        completion_date: '',
        price: '',
        quantity: '',
        note: ''
      })
    },
    remove (item) {
      let index = this.invoice_items.indexOf(item)
      this.invoice_items.splice(index, 1)
    }
  },
  created () {
    bus.$on('open_dialog_invoice_addition', (payload) => {
      this.is_active = true
    })
  }
}
</script>