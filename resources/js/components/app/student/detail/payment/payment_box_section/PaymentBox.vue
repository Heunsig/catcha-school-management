<template>
  <div class="ca-invoice-item">
    <div class="__title">
      <div class="ca-typo-title-4 mr-2">{{ payment_code }}</div>
      <v-chip 
        label 
        :color="status_color"
        text-color="white"
      >
        {{ payment.status }}
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
          <v-icon color="grey darken-2">local_printshop</v-icon>
        </v-btn>
        <v-list dense>
          <v-list-tile @click="print(payment.id)">
            <v-list-tile-title>Print Receipt</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>

      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        offset-y
        top
        z-index="2"
        :nudge-right="20"
      >
        <v-btn
          slot="activator"
          icon
        >
          <v-icon color="grey darken-2">more_vert</v-icon>
        </v-btn>
        <v-list dense>
          <v-list-tile @click="open_dialog_status_change()" v-if="!is_paid">
            <v-list-tile-title>Change Stauts</v-list-tile-title>
          </v-list-tile>
          <v-list-tile @click="open_dialog_deletion()">
            <v-list-tile-title>Delete</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
    </div>
    <div class="__body">
      <div class="__header mb-3">
        <div>
          <strong class="pr-1">Date Issued</strong>
          <span class="ca-typo-style-meta">{{ date_issued }}</span>
          <strong class="ml-2 pr-1">Payment Method</strong>
          <span class="ca-typo-style-meta">
            {{ payment.payment_method.method }}
            <v-menu
              v-if="payment.payment_method.key === 'CC'"
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
                
                <v-card>
                  <v-card-title>Credit Card Details</v-card-title>
                  <v-card-text>
                    <div>
                      <div>The Last 4 Digits</div>
                      <div>{{ payment.payment_method.details.digits }}</div>
                    </div>
                    <div>
                      <div>Name on Card</div>
                      <div>{{ payment.payment_method.details.name }}</div>
                    </div>
                    <div>
                      <div>Expiration</div>
                      <div>{{ payment.payment_method.details.month+'/'+payment.payment_method.details.year }}</div>
                    </div>
                  </v-card-text>
                </v-card>
            </v-menu>
          </span>
        </div>
        <div>
          <strong>Note</strong>
          <span>{{ payment.note }}</span>
        </div>
      </div>
      <div class="__detail">
        <table class="ca-table">
          <thead>
            <tr>
              <th class="text-xs-left">Name</th>
              <th class="text-xs-center">Week</th>
              <th class="text-xs-center">Qauntity</th>
              <th class="text-xs-right">Price</th>
              <th class="text-xs-right">Total</th>
            </tr>
          </thead>
          <tbody>
            <PaymentDetail
              v-for="item in items"
              :key="item.id"
              :item="item"
            ></PaymentDetail>
          </tbody>
        </table>
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
import PaymentDetail from './PaymentDetail'
// import TrackingBox from '../class/list/TrackingBox'

export default {
  components: {
    PaymentDetail,
    // TrackingBox
  },
  props: {
    payment: Object
  },
  data: () => ({
    menu: false,
    credit_card_menu: false,
    print_menu: false,
  }),
  computed: {
    items () {
      return this.payment.items
    },
    payment_code () {
      return 'Receipt #'+ this.payment.id
    },
    date_issued () {
      return this.$moment(this.payment.payment_date).format('MM/DD/YYYY')
    },
    total_refund () {
      let result = 0
      for(let i in this.items) {
        if (this.items[i].is_refunded) {
          result += this.items[i].price
        }
      }

      return result
    },
    sub_total () {
      let result = 0
      for(let i in this.items) {
        result += this.items[i].price
      }

      return result
    },
    total () {
      return this.sub_total - this.total_refund
    },
    status_color () {
      if (this.payment.status === 'Paid') {
        return 'green lighten-1'
      } else if (this.payment.status === 'Waiting') {
        return 'amber darken-1'
      } else if (this.payment.status === 'Canceled') {
        return 'grey darken-1'
      }
    },
    is_paid () {
      return this.payment.status === 'Paid'
    },
    is_refunded () {
      return this._.filter(this.items, 'is_refunded').length > 0 ? true : false
    },
    is_deleted () {
      return this.payment.administration.deleted_at
    }
  },
  methods: {
    open_dialog_status_change () {
      bus.$emit('open_dialog_status_change', {
        payment: this.payment
      })
    },
    open_dialog_deletion () {
      bus.$emit('open_dialog_deletion', {
        payment: this.payment
      })
    },
    // open_dialog_refund () {
    //   bus.$emit('open_dialog_refund', {
    //     payment: this.payment
    //   })
    // },
    format_money (money) {
      return this.$account.formatMoney(money)
    },
    print (id) {
      window.open(`${this.$config.BASE_URL}/pdf/${id}`, '_blank');
    }
  }
}
</script>