<template>
  <v-dialog v-model="is_active" persistent max-width="700">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">History of {{ program.name }}</h4>
      </v-card-title>
      <v-card-text>
        <table class="insty-table">
          <thead>
            <tr>
              <th style="width: 120px;">Start date</th>
              <th style="width: 120px;">Completion date</th>
              <th>Reason</th>
              <th style="width: 90px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(date, i) in program_dates">
              <Item
                :index="i"
                :date="date"
                :program="program"
              ></Item>
            </template>
          </tbody>
        </table>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'
import Item from './ProgramTermHistoryItem'
export default {
  components: {
    Item
  },
  data () {
    return {
      is_active: false,
      program: {},
    }
  },
  computed: {
    program_dates () {
      return this.program.dates
    }
  },
  created () {
    bus.$on('dialog:program_term_history', payload => {
      console.log('dd', payload.program)
      this.is_active = true
      this.program = payload.program

    })
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
    border-collapse: collapse;
  }

  .insty-table thead tr th {
    padding: 7px 0;
    border-bottom: 1px solid #cecece;
  }

  /*.insty-table td {
    padding: 5px 0;
  }*/
</style>