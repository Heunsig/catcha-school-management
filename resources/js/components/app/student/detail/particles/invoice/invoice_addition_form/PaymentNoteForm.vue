<template>
  <div>
    <!-- <div class="ca-typo-title-5">Note</div> -->
    <v-container fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs12>
          <v-textarea
            :value="note"
            @input="$emit('update:note', $event)"
            label="Note"
          >
          </v-textarea>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>
export default {
  props: [
    'note'
  ]
  // data: () => ({
  //   note: ''
  // }),
  // watch: {
  //   note (new_val) {
  //     this.$store.commit('invoice/set_note', {
  //       note: new_val
  //     })
  //   }
  // }
}
</script>