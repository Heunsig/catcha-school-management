<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <ProgramList></ProgramList>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import ProgramList from './program_list/Index'

export default {
  components: {
    ProgramList
  }
}
</script>