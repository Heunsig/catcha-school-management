<template>
  <v-card>
    <v-card-title>
      <h3 class="ca-typo-title-4">Leave</h3>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-1">
        <v-layout wrap>
          <v-flex xs6>
            <ComingSection></ComingSection>
          </v-flex>
          <v-flex xs6>
            <FinishingSection></FinishingSection>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>
<script>
import ComingSection from './coming/Index'
import FinishingSection from './finishing/Index'

export default {
  components: {
    ComingSection,
    FinishingSection
  }
}
</script>