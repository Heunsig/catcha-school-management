<template>
  <tr>
    <td class="text-xs-left __item-name"><strong>{{ item.name }}</strong></td>
    <td class="text-xs-center __item-term">{{ item.week }}</td>
    <td class="text-xs-right __item-quantity">{{ item.quantity }}</td>
    <td class="text-xs-right __item-price">{{ $account.formatMoney(item.price) }}</td>
    <td class="text-xs-right __item-total">{{ $account.formatMoney(total) }}</td>
  </tr>
</template>
<script>
export default {
  props: {
    item: Object
  },
  computed: {
    is_refunded () {
      return this.item.is_refunded
    },
    total () {
      return this.item.quantity * this.item.price
    },
  }
}
</script>
<style scoped>
  .test {
    text-decoration: line-through;
  }
</style>
