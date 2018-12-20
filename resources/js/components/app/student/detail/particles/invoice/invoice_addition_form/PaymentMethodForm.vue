<template>
  <div>
    <!-- <div class="ca-typo-title-5">Payment Method</div> -->
    <v-container fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs12>
          <v-select
            :value="method_key"
            @input="$emit('update:method_key', $event)"
            :items="payment_methods"
            label="Payment Method"
            item-text="method"
            item-value="key"
          ></v-select>
        </v-flex>
        <v-flex xs12 v-if="method_key === 'CC'">
          <credit-card
            :digits.sync="detail.digits"
            :name.sync="detail.name"
            :month.sync="detail.month"
            :year.sync="detail.year"
          ></credit-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>
import CreditCard from './payment_method_form/CreditCard'

export default {
  components: {
    CreditCard
  },  
  props: {
    payment_methods: Array,
    method_key: String,
    detail: Object
  },
  data: () => ({
    // selected_payment_method: {},
    // detail: {}  
  }),
  computed: {
    // payment_method_form () {
    //   if (this.selected_payment_method === 'CC') {
    //     return 'CreditCard'
    //   }
    // }
  },
  watch: {
    method_key (nv) {
      console.log('nve', nv)
    }
  }
  // watch: {
  //   selected_payment_method (new_val) {
  //     this.$store.commit('invoice/set_payment_method_key', {
  //       payment_method_key: new_val
  //     })

  //     console.log(this.$store.getters['invoice/payment_method_key'])
  //   }
  // }
}
</script>