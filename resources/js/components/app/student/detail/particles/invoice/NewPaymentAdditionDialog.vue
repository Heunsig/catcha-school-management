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
          @click="reset()"
        >
          Clear
        </v-btn>
        <v-btn 
          color="primary"
          @click="add_item()"
        >
          Add New Item
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
                          ref="payment_information_form"
                        ></PaymentInformationForm>
                      </v-card-text>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-flex>
            <v-flex xs7>
              <v-container fluid class="pa-0 ca-grid-list-6-b">
                <v-layout wrap>
                  <v-flex xs12>
                    <v-card>
                      <v-card-title>
                        <div class="ca-typo-title-5">Invoice Details</div>
                      </v-card-title>
                    </v-card>
                  </v-flex>
                  <template v-if="reversed_payment_items.length">
                    <v-flex xs12 v-for="(item, i) in reversed_payment_items" :key="item.GUID">
                      <invoice-item-form
                        ref="payment_item"
                        :GUID="item.GUID"
                        :index="reversed_payment_items.length - i"
                        @remove="remove(item)"
                      ></invoice-item-form>
                    </v-flex>
                  </template>
                  <template v-else>
                    <v-flex xs12>
                      <div class="ca-typo-title-5 text-xs-center">
                        Please add new item.
                      </div>
                    </v-flex>
                  </template>
                </v-layout>
              </v-container>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions class="primary">
        <v-spacer></v-spacer>
        <v-btn color="white" flat @click="is_active = false">Disagree</v-btn>
        <v-btn 
          color="white" 
          flat 
          @click="submit()"
          :loading="wating_result"
        >Agree</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'

import PaymentInformationForm from './invoice_addition_form/PaymentInformationForm'
import InvoiceItemForm from './invoice_addition_form/InvoiceItemForm'

export default {
  components: {
    InvoiceItemForm,
    PaymentInformationForm
  },
  data: () => ({
    is_active: false,
    wating_result: false,
    payment_items: [
      { GUID: 'first' }
    ],
  }),
  computed: {
    reversed_payment_items () {
      let reversed_payment_items = _.reverse(_.clone(this.payment_items))
      return reversed_payment_items
    }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {
        this.reset()
      }
    }
  },
  methods: {
    validate_all () {
      let error = 0
      let result = {
        items: []
      }

      if (this.$refs['payment_information_form'].validate()) {
        Object.assign(result, this.$refs['payment_information_form'].validate())
      } else {
        error += 1
      }

      for (let i = 0 ; i < this.$refs['payment_item'].length ; i++) {
        if (this.$refs['payment_item'][i].validate()) {
          result.items.push(this.$refs['payment_item'][i].validate())
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
      let data = this.validate_all()

      if (data) {
        this.wating_result = true
        this.$store.dispatch('payment/store', {
          form: {
            student_id: this.$route.params.student_id,
            status: data.status,
            note: data.note,
            method_key: data.method_key,
            payment_method_details: data.details || null,
            items: data.items
          }
        }).then(res => {
          // console.log('res', res)
          this.wating_result = false
          this.is_active = false
        })
      }
    },
    add_item () {
      this.payment_items.push({
        GUID: this.generate_guid()
      })
    },
    remove (item) {
      let index = this.payment_items.indexOf(item)
      this.payment_items.splice(index, 1)
    },
    reset () {
      this.$refs['payment_item'].forEach(item => {
        item.reset()
      })
      this.$refs['payment_information_form'].reset()
      this.payment_items = [
        { GUID : 'first' }
      ]
    }
  },
  created () {
    bus.$on('open_dialog_payment_addition', (payload) => {
      this.is_active = true
    })
  }
}
</script>