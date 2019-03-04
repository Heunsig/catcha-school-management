<template>
  <v-container fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <DocumentList></DocumentList>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import DocumentList from './document_list/Index'

export default { 
  components: {
    DocumentList
  }
}
</script>
