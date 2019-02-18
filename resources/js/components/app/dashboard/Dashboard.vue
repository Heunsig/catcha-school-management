<template>
  <v-container fluid class="pa-0 ca-grid-list-2">
    <v-layout wrap>
      <v-flex xs8>
        <NewStudentSection></NewStudentSection>
      </v-flex>
      <v-flex xs4>
        <!-- <CurrentStudyingStudent></CurrentStudyingStudent> -->
      </v-flex>
    </v-layout>
    <v-layout wrap>
      <v-flex xs6>
        <ProgramSection></ProgramSection>
      </v-flex>
      <v-flex xs6>
        <LeaveSection></LeaveSection>
      </v-flex>
      <!-- <v-flex xs3>
        <ComingProgramSection
          :is_ready="is_ready"
        ></ComingProgramSection>
      </v-flex>
      <v-flex xs3>
        <FinishingProgramSection
          :is_ready="is_ready"
        ></FinishingProgramSection>
      </v-flex> -->
      <!-- <v-flex xs3>
        <ComingLeaveSection
          :is_ready="is_ready"
        ></ComingLeaveSection>
      </v-flex>
      <v-flex xs3>
        <FinishingLeaveSection
          :is_ready="is_ready"
        ></FinishingLeaveSection>
      </v-flex> -->
    </v-layout>
    <!-- <ComingProgramExtensionDialog></ComingProgramExtensionDialog> -->
  </v-container>
</template>
<script>
import NewStudentSection from './new_student_section/Index'
import ProgramSection from './program_section/Index'
import LeaveSection from './leave_section/Index'
// import CurrentStudyingStudent from './current'
// import ComingProgramSection from './coming_program_section/Index'
// import FinishingProgramSection from './finishing_program_section/Index'
import ComingLeaveSection from './coming_leave_section/Index'
import FinishingLeaveSection from './finishing_leave_section/Index'

// import ComingProgramExtensionDialog from './particles/dialogs/ComingProgramExtensionDialog'

export default {
  components: {
    NewStudentSection,
    ProgramSection,
    LeaveSection,
    // CurrentStudyingStudent,
    // ComingProgramSection,
    // FinishingProgramSection,
    ComingLeaveSection,
    FinishingLeaveSection,
    // ComingProgramExtensionDialog
  },
  data () {
    return {
      is_ready: false
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
    this.$store.dispatch('dashboard/get_init').then(res => {
      console.log('hi')
      this.is_ready = true
    }).catch(err => {
      console.log('Error!!')
    });
  }
}
</script>