<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1100">
    <v-card>
      <v-card-title class="primary white--text ca-typo-title-4">
        Issue New Receipt
        <v-spacer></v-spacer>
        <!-- <div>
          <strong>Total:</strong>
          <span>{{ $account.formatMoney(total) }}</span>
        </div> -->
        <v-btn 
          color="primary"
          depressed
          @click="add_product()"
        >
          Add Product
        </v-btn>
      </v-card-title>
      <v-card-text class="grey lighten-4">
        <v-container fluid class="pa-0 ca-grid-list-2">
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
                        <PaymentInformationForm
                          :payment_methods="payment_methods"
                          ref="payment_information_form"
                        ></PaymentInformationForm>
                        <!-- <payment-status-form
                          :status.sync="status"
                        >
                        </payment-status-form>
                        
                        <payment-method-form
                          :payment_methods="payment_methods"
                          :method_key.sync="payment_method.method_key"
                          :detail.sync="payment_method.detail"
                        ></payment-method-form>
                        
                        <payment-note-form
                          :note.sync="note"
                        >
                        </payment-note-form> -->
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
            <v-flex xs7>
              <v-container fluid class="pa-0 ca-grid-list-6-b">
                <v-layout wrap>
                  <v-flex xs12 v-for="(invoice_item, i) in reversed_invoice_items" :key="invoice_item.GUID">
                    <invoice-item-form
                      ref="invoice"
                      :index="reversed_invoice_items.length - i"
                      :products="products"
                      @remove="remove(invoice_item)"
                    ></invoice-item-form>
                    <!-- <invoice-item-form
                      :key="invoice_item.GUID"
                      :products="products"
                      :product.sync="invoice_item.product_id"
                      :start_date.sync="invoice_item.start_date"
                      :completion_date.sync="invoice_item.completion_date"
                      :price.sync="invoice_item.price"
                      :quantity.sync="invoice_item.quantity"
                      :note.sync="invoice_item.note"
                      @remove="remove(invoice_item)"
                    ></invoice-item-form> -->
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

import PaymentInformationForm from './invoice_addition_form/PaymentInformationForm'
// import PaymentMethodForm from './invoice_addition_form/PaymentMethodForm'
// import PaymentStatusForm from './invoice_addition_form/PaymentStatusForm'
// import PaymentNoteForm from './invoice_addition_form/PaymentNoteForm'
import InvoiceItemForm from './invoice_addition_form/InvoiceItemForm'

export default {
  props: {
    payment_methods: Array,
    products: Array
  },
  components: {
    // PaymentMethodForm,
    // PaymentStatusForm,
    // PaymentNoteForm,
    InvoiceItemForm,
    PaymentInformationForm
  },
  data: () => ({
    is_active: false,
    total: 0,
    // status: '',
    // note: '',
    // payment_date: '',
    // payment_method: {
    //   method_key: null,
    //   detail: {}
    // },
    invoice_items: []
  }),
  computed: {
    reversed_invoice_items () {
      let reversed_invoice_items = _.reverse(_.clone(this.invoice_items))
      return reversed_invoice_items
    }
  },
  methods: {
    validate_all () {
      let error = 0
      let result = {
        payment: {},
        invoice_items: []
      }


      if (this.$refs['payment_information_form'].validate()) {
        result.payment = this.$refs['payment_information_form'].validate()
      } else {
        error += 1
      }
      
      for (let i = 0 ; i < this.$refs['invoice'].length ; i++) {
        if (this.$refs['invoice'][i].validate()) {
          result.invoice_items.push(this.$refs['invoice'][i].validate())
        } else {
          error += 1
        }
      }

      if (error > 0) {
        return false
      } else {
        return result  
      }
    },
    submit () {
      // console.log('v', this.validate_all())
      let data = this.validate_all()

      if (data) {
        this.$axios.post(`/invoice`, {
          student_id: this.$route.params.student_id,
          status: data.payment.information.status,
          note: data.payment.information.note,
          payment_method: {
            method_key: data.payment.information.method_key,
            detail: data.payment.detail
          },
          invoice_items: data.invoice_items
        }).then(res => {
          console.log('res', res)
        })
      }
    },
    add_product () {
      this.invoice_items.push({
        GUID: this.guid()
      })
      // this.invoice_items.push({
      //   GUID: this.guid(),
      //   product_id: null,
      //   start_date: '',
      //   completion_date: '',
      //   price: '',
      //   quantity: '',
      //   note: ''
      // })
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