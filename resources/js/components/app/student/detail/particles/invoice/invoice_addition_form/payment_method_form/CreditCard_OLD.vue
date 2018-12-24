<template>
  <v-container fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-text-field
          :value="digits"
          @input="$emit('update:digits', $event)"
          label="Last 4 card digits"
        >
        </v-text-field>
      </v-flex>
      <v-flex xs12>
        <v-text-field
          :value="name"
          @input="$emit('update:name', $event)"
          label="Name on card"
        >
        </v-text-field>
      </v-flex>
      <v-flex xs6>
        <v-text-field
          :value="month"
          @input="$emit('update:month', $event)"
          label="Expiration Month"
        >
        </v-text-field>
      </v-flex>
      <v-flex xs6>
        <v-text-field
          :value="year"
          @input="$emit('update:year', $event)"
          label="Expiration Year"
        >
        </v-text-field>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  props: [
    'digits',
    'name',
    'month',
    'year'
  ],
  // data: () => ({
  //   form: {
  //     digits: '',
  //     name: '',
  //     month: '',
  //     year: ''
  //   }
  // }),
  // watch: {
  //   form: {
  //     handler: function (new_val) {
  //       this.$store.commit('invoice/set_payment_method_detail', new_val)
  //     },
  //     deep: true
  //   }
  // }
}
</script>