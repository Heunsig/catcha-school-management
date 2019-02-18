<template>
  <tr>
    <td class="text-xs-left __item-name">
      <strong>{{ item.name }}</strong>
      <div class="insty-att-box">
        <template v-for="att in item.attributes">
          <div class="insty-att">
            <span class="insty-att-name">{{ att.attribute }}</span>
            <span class="insty-att-value">{{ att.value }}</span>
          </div>
        </template>
      </div>
    </td>
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

  .insty-att-box {

  }

  .insty-att {
    display: inline-block;
    margin-right: 10px;
  }

  .insty-att-name {
    font-size: 0.93em;
    font-weight: bold;
    color: #868686;
  }

  .insty-att-value {
    font-size: 0.93em;
    color: #868686;
  }
</style>
