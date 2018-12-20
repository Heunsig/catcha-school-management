<template>
  <div>
    <!-- <div class="ca-typo-title-5">Payment Status</div> -->
    <v-container fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs12>
          <v-select
            :value="status"
            @input="$emit('update:status', $event)"
            :items="STATUS_ITEMS"
            label="Payment Status"
          >
          </v-select>          
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>

export default {
  props: [
    'status'
  ]
  // data: () => ({
  //   status: '',
  // }),
  // watch: {
  //   status (new_val) {
  //     this.$store.commit('invoice/set_status', {
  //       status: new_val
  //     })
  //   }
  // }
}
</script>