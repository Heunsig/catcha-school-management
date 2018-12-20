<template>
  <!-- <div class="__item"> -->
  <tr>
    <td class="text-xs-left __item-name"><strong :class="{'test':is_refunded}">{{ name }}</strong></td>
    <td class="text-xs-center __item-term">{{ term }}</td>
    <td class="text-xs-right __item-quantity">{{ quantity }}</td>
    <td class="text-xs-right __item-price">{{ $account.formatMoney(price) }}</td>
    <td class="text-xs-right __item-total">{{ $account.formatMoney(total) }}</td>
  </tr>
    <!-- <div class="__name" :class="{'test':is_refunded}">
      {{ name }} {{ term }}
      <v-chip 
        color="primary" 
        text-color="white" 
        small 
        v-if="is_refunded"
      >
        Refunded
      </v-chip>
    </div>
    <v-spacer></v-spacer>
    <div class="__quantity">{{ invoice.quantity }}</div>
    <div class="__price" :class="{'test':is_refunded}">{{ formatted_price }}</div>
    <div class="__total">{{ $account.formatMoney(total) }}</div> -->
  <!-- </div> -->
</template>
<script>
export default {
  props: {
    invoice: Object
  },
  computed: {
    item_id () {
      return 'ITEM-' + this.invoice.id
    },
    is_refunded () {
      return this.invoice.is_refunded
    },
    name () {
      return this.invoice.product_name
    },
    start_date () {
      return this.invoice.start_date ? this.$moment(this.invoice.start_date).format('MM/DD/YYYY'):null
    },
    completion_date () {
      return this.invoice.completion_date ? this.$moment(this.invoice.completion_date).format('MM/DD/YYYY'):null
    },
    // formatted_price () {
    //   return this.$account.formatMoney(this.invoice.price)
    // },
    term () {
      if (this.start_date && this.completion_date) {
        return `${this.start_date} - ${this.completion_date}`
      } else if (this.start_date) {
        return `${this.start_date} - Not Decided`
      } else if (this.completion) {
        return `Not Decided - ${this.completion_date}`
      } else {
        return null
      }
    },
    quantity () {
      return this.invoice.quantity ? this.invoice.quantity:null
    },
    price () {
      return this.invoice.price ? this.invoice.price:null
    },
    total () {
      return this.invoice.quantity * this.invoice.price
    },
  }
}
</script>
<style scoped>
  .test {
    text-decoration: line-through;
  }
</style>
