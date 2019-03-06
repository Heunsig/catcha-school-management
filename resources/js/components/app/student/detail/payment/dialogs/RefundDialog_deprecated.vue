<template>
  <v-dialog v-model="is_active" persistent max-width="1000">
    <v-card>
      <v-card-title class="ca-typo-title-4">Refund</v-card-title>
      <v-card-text>
        <table class="ca-table">
          <thead>
            <tr>
              <th></th>
              <th class="text-xs-center">Name</th>
              <th class="text-xs-center">Date</th>
              <th class="text-xs-center">Quantity</th>
              <th class="text-xs-center">Price</th>
              <th class="text-xs-center">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in invoice.invoice_items" :key="item.id">
              <td class="__column-checkbox">
                <v-checkbox
                  v-model="selected"
                  :value="item.id"
                  hide-details
                  class="ma-0 pa-0"
                  :disabled="is_refunded(item.is_refunded)"
                ></v-checkbox>
              </td>
              <td class="__column-name"><strong :class="{'test':is_refunded(item.is_refunded)}">{{ item.product_name }}</strong></td>
              <td class="text-xs-center __column-term">{{ term(item.start_date, item.completion_date) }}</td>
              <td class="text-xs-center __column-quantity">{{ item.quantity }}</td>
              <td class="text-xs-right __column-price">{{ $account.formatMoney(item.price) }}</td>
              <td class="text-xs-right __column-total">{{ $account.formatMoney(total(item.quantity, item.price)) }}</td>
            </tr>
          </tbody>
        </table>
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
    invoice: {},
    selected: [],
    wating_result: false
  }),
  watch: {
    selected (new_val) {
      console.log('selected', new_val)
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$axios.post(`/invoice/${this.invoice.id}/refund`,{
        invoice: this.invoice,
        student_id: this.$route.params.student_id,
        refunded_product_ids: this.selected
      }).then(res => {
        this.$emit('refund', {
          new: res.data,
          old: this.invoice
        })

        this.is_active = false
        this.wating_result = false
      })
    },
    term (start_date, completion_date) {
      if (start_date && completion_date) {
        return `${start_date} - ${completion_date}`
      } else if (start_date) {
        return `${start_date} - Not Decided`
      } else if (completion_date) {
        return `Not Decided - ${completion_date}`
      } else {
        return null
      }
    },
    total (quantity, price) {
      return quantity * price
    },
    is_refunded (value) {
      return value ? true:false
    },
  },
  created () {
    bus.$on('open_dialog_refund', (payload) => {
      this.is_active = true
      this.selected = []
      this.invoice = payload.invoice
    })
  }
}
</script>
<style scoped>
  .__column-checkbox {
    width: 5%;
  }
  .__column-name {
    width: auto;
  }

  .__column-term {
    width: 25%;
  }

  .__column-quantity {
    width: 6%;
  }

  .__column-price {
    width: 13%;
  }

  .__column-total {
    width: 15%;
  }
</style>
<style scoped>
  .test {
    text-decoration: line-through;
  }
</style>