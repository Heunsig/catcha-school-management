<template>
  <tr>
    <td class="text-xs-center">{{ date.start_date ? $moment(date.start_date).format('MM/DD/Y') : '' }}</td>
    <td class="text-xs-center">{{ $moment(date.completion_date).format('MM/DD/Y') }}</td>
    <td>{{ date.reason }}</td>
    <td class="text-xs-center">
      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-width="200"
        offset-x
        v-if="index > 0"
      >
        <v-icon slot="activator" small color="grey darken-2" class="ca-cursor-pointer">close</v-icon>
        <v-card>
          <v-card-title>
            <h5 class="ca-typo-title-5">Do you want to delete {{ date.completion_date }}</h5>
          </v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat small color="grey darken-2" @click="menu = false">Cancel</v-btn>
            <v-btn flat small color="red" @click="submit()" :loading="wating_result">Continue</v-btn>
          </v-card-actions>
        </v-card>
      </v-menu>
    </td>
  </tr>
</template>
<script>
export default {
  props: [
    'index',
    'date',
    'program'
  ],
  data () {
    return {
      menu: false,
      wating_result: false
    }
  },
  methods: {
    submit () {
      this.wating_result = true
      this.$store.dispatch('class/destroy_program_term', {
        program_id: this.program.id,
        date_id: this.date.id
      }).then(res => {
        this.wating_result = false
        this.menu = false
      })
    }
  }
}
</script>
<style scoped>
  tr td {
    padding: 10px 0;
  }
</style>