<template>
  <v-container fluid class="pa-0 ca-grid-list-4">
    <v-layout wrap>
      <v-flex xs8>
        <NewStudentSection></NewStudentSection>
      </v-flex>
      <v-flex xs4>
        <CurrentStudyingStudent></CurrentStudyingStudent>
      </v-flex>
    </v-layout>
    <v-layout wrap>
      <v-flex xs3>
        <ComingProgramSection></ComingProgramSection>
      </v-flex>
      <v-flex xs3>
        <FinishingProgramSection></FinishingProgramSection>
      </v-flex>
      <v-flex xs3>
        <ComingLeaveSection></ComingLeaveSection>
      </v-flex>
      <v-flex xs3>
        <FinishingLeaveSection></FinishingLeaveSection>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import NewStudentSection from './particles/NewStudentSection'
import CurrentStudyingStudent from './particles/CurrentStudyingStudentSection'
import ComingProgramSection from './particles/ComingProgramSection'
import FinishingProgramSection from './particles/FinishingProgramSection'
import ComingLeaveSection from './particles/ComingLeaveSection'
import FinishingLeaveSection from './particles/FinishingLeaveSection'

export default {
  components: {
    NewStudentSection,
    CurrentStudyingStudent,
    ComingProgramSection,
    FinishingProgramSection,
    ComingLeaveSection,
    FinishingLeaveSection
  },
  data () {
    return {
      items: [
        { active: true, title: 'Jason Oner', avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg' },
        { active: true, title: 'Ranee Carlson', avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg' },
        { title: 'Cindy Baker', avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg' },
        { title: 'Ali Connors', avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg' }
      ],
    }
  },
  computed: {
    coming_programs () {
      return this.$store.getters['dashboard/coming_programs']
    },
    finishing_programs() {
      return this.$store.getters['dashboard/finishing_programs']
    },
    coming_leaves() {
      return this.$store.getters['dashboard/coming_leaves']
    },
    finishing_leaves() {
      return this.$store.getters['dashboard/finishing_leaves']
    },
  },
  created () {
    this.$store.dispatch('dashboard/get_init');
  }
}
</script>