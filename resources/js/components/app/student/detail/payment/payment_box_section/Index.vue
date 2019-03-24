<template>
  <div>
    <template v-if="loading">
      <div class="ca-loading-box">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </div>
    </template>
    <template v-else>
      <template v-if="_.isEmpty(filtered_payments)">
        <div class="ca-nodata-box">
          <div class="ca-nodata-box__message">
            <v-icon>sentiment_very_dissatisfied</v-icon>
            <div class="message">Nothing to see here</div>
          </div>
        </div>
      </template>
      <template v-else>
        <v-container fluid class="pa-0 ca-grid-list-4-y">
          <v-layout wrap>
            <v-flex xs12 
              v-for="payment in filtered_payments" 
              :key="payment.id"
            >
              <PaymentBox
                :payment="payment"
              ></PaymentBox>
            </v-flex>
          </v-layout>
        </v-container>
      </template>
    </template>
  </div>
</template>
<script>
import PaymentBox from './PaymentBox'
export default {
  components: {
    PaymentBox
  },
  props: [
    'filtered_by'
  ],
  data () {
    return {
      loading: false
    }
  },
  computed: {
    payments () {
      return this.$store.getters['student/payment/payments']
    },
    filtered_payments () {
      let $this = this
      let filtered_data = this._.reverse(this._.clone(this.payments))

      if (this.filtered_by.indexOf('Deleted') < 0 ) { 
        filtered_data = this._.filter(filtered_data, function (o) {
          return o.administration.deleted_at === null
        })
      }

      return this._.filter(filtered_data, function(o) {
        return $this.filtered_by.indexOf(o.status) > -1 ? true : false
      })
    },
  },
  created () {
    this.loading = true
    this.$store.dispatch('student/payment/init_data', {
      student_id: this.$route.params.student_id
    }).then(res => {
      this.loading = false
    })
  }
}
</script>