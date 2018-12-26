<template>
  <div class="ca-invoice-item">
    <div class="__title">
      <div class="ca-typo-title-4 mr-2">{{ invoice_code }}</div>
      <v-chip 
        label 
        :color="status_color"
        text-color="white"
      >
        {{ invoice.status }}
      </v-chip>
      <v-chip label color="red" text-color="white" v-if="is_deleted">Deleted</v-chip>
      <v-spacer></v-spacer>
      <v-menu
        v-model="print_menu"
        :close-on-content-click="false"
        offset-y
        top
        z-index="2"
        class="test"
      >
        <v-btn
          slot="activator"
          icon
        >
          <v-icon color="blue darken-2">local_printshop</v-icon>
        </v-btn>
        <v-card>  
          <v-card-text>
            <div class="ca-menu-action">
              <ul class="__button-list">
                <li class="__button">
                  <v-btn
                    depressed
                    block
                    color="red"
                    dark
                    @click="print(invoice.id)"
                  >
                    Print Receipt
                  </v-btn>
                </li>
                </li>
              </ul>
            </div>
          </v-card-text>
        </v-card>
      </v-menu>

      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        offset-y
        top
        z-index="2"
      >
        <v-btn
          slot="activator"
          icon
        >
          <v-icon color="blue darken-2">build</v-icon>
        </v-btn>
        <v-card>
          <v-card-text>
            <div class="ca-menu-action">
              <ul class="__button-list">
                <li class="__button">
                  <v-btn
                    depressed
                    block
                    color="yellow darken-3"
                    :dark="!is_paid"
                    :disabled="is_paid"
                    @click="open_dialog_status_change()"
                  >
                    Change Status
                  </v-btn>
                </li>
                <li class="__button">
                  <v-btn
                    depressed
                    block
                    color="red"
                    :dark="is_paid"
                    :disabled="!is_paid"
                    @click="open_dialog_refund()"
                  >
                    Refund
                  </v-btn>
                </li>
                <li class="__button">
                  <v-btn
                    depressed
                    block
                    color="red"
                    dark
                    @click="open_dialog_deletion()"
                  >
                    Delete
                  </v-btn>
                </li>
              </ul>
            </div>
            <v-divider></v-divider>
            <tracking-box
              :item="invoice"
            ></tracking-box>
          </v-card-text>
        </v-card>
      </v-menu>
    </div>
    <div class="__body">
      <div class="__header mb-3">
        <div>
          <strong class="pr-1">Date Issued</strong>
          <span class="ca-typo-style-meta">{{ date_issued }}</span>
          <strong class="ml-2 pr-1">Payment Method</strong>
          <span class="ca-typo-style-meta">
            {{ invoice.payment_method }}
            <v-menu
              v-if="invoice.payment_method_key === 'CC'"
              v-model="credit_card_menu"
              :close-on-content-click="false"
              :nudge-width="200"
              offset-x
              z-index="2"
            >
                <v-icon
                  slot="activator"
                  small
                >
                  credit_card
                </v-icon>
                
                <!-- <v-card>
                  <v-card-title>Credit Card Details</v-card-title>
                  <v-card-text>
                    <div>
                      <div>The Last 4 Digits</div>
                      <div>{{ invoice.payment_method_detail.digits }}</div>
                    </div>
                    <div>
                      <div>Name on Card</div>
                      <div>{{ invoice.payment_method_detail.name }}</div>
                    </div>
                    <div>
                      <div>Expiration</div>
                      <div>{{ invoice.payment_method_detail.month/invoice.payment_method_detail.year }}</div>
                    </div>
                  </v-card-text>
                </v-card> -->
            </v-menu>
          </span>
        </div>
        <div>
          <strong>Note</strong>
          <span>{{ invoice.note }}</span>
        </div>
      </div>
      <div class="__detail">
        <table class="ca-table">
          <thead>
            <tr>
              <th class="text-xs-left">Name</th>
              <th class="text-xs-center">Date</th>
              <th class="text-xs-center">Qauntity</th>
              <th class="text-xs-right">Price</th>
              <th class="text-xs-right">Total</th>
            </tr>
          </thead>
          <tbody>
            <invoice-item
              v-for="item in invoice.invoice_items"
              :key="item.id"
              :invoice="item"
            ></invoice-item>
          </tbody>
        </table>
        <!-- <invoice-item
          v-for="item in invoice.invoice_items"
          :key="item.id"
          :invoice="item"
        ></invoice-item> -->
      </div>
      <div class="__result">
        <div class="__result-meta">
          <strong class="ca-typo-title-5">Sub Total</strong>
          <span>{{ format_money(sub_total) }}</span>
        </div>
        <div class="__result-meta">
          <strong class="ca-typo-title-5">Refund</strong>
          <span>{{ format_money(total_refund) }}</span>  
        </div>
        <div class="__result-meta">
          <strong class="ca-typo-title-4">Total</strong>
          <span class="ca-typo-4">{{ format_money(total) }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import bus from 'bus'
import InvoiceItem from './InvoiceItem'
import TrackingBox from '../class/list/TrackingBox'

export default {
  components: {
    InvoiceItem,
    TrackingBox
  },
  props: {
    invoice: Object
  },
  data: () => ({
    menu: false,
    credit_card_menu: false,
    print_menu: false,
  }),
  computed: {
    invoice_code () {
      return 'Receipt #'+ this.invoice.id
    },
    date_issued () {
      return this.$moment(this.invoice.payment_date).format('MM/DD/YYYY')
    },
    total_refund () {
      let result = 0
      for(let i in this.invoice.invoice_items) {
        if (this.invoice.invoice_items[i].is_refunded) {
          result += this.invoice.invoice_items[i].price
        }
      }

      return result
    },
    sub_total () {
      let result = 0
      for(let i in this.invoice.invoice_items) {
        result += this.invoice.invoice_items[i].price
      }

      return result
    },
    total () {
      return this.sub_total - this.total_refund
    },
    status_color () {
      if (this.invoice.status === 'Paid') {
        return 'green lighten-1'
      } else if (this.invoice.status === 'Waiting') {
        return 'amber darken-1'
      } else if (this.invoice.status === 'Canceled') {
        return 'grey darken-1'
      }
    },
    is_paid () {
      return this.invoice.status === 'Paid'
    },
    is_refunded () {
      return this._.filter(this.invoice.invoice_items, 'is_refunded').length > 0 ? true : false
    },
    is_deleted () {
      return this.invoice.deleted_at
    }
  },
  methods: {
    open_dialog_status_change () {
      bus.$emit('open_dialog_status_change', {
        invoice: this.invoice
      })
    },
    open_dialog_deletion () {
      bus.$emit('open_dialog_deletion', {
        invoice: this.invoice
      })
    },
    open_dialog_refund () {
      bus.$emit('open_dialog_refund', {
        invoice: this.invoice
      })
    },
    format_money (money) {
      return this.$account.formatMoney(money)
    },
    print (id) {
      window.open(`${this.$config.BASE_URL}/pdf/${id}`, '_blank');
    }
  }
}
</script>