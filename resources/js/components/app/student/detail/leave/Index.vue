<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Leave</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary" @click="open_dialog_leave_addition()">Add Leave of Absence</v-btn>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12>
            <LeaveRequestList></LeaveRequestList>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>

    <LeaveAdditionDialog></LeaveAdditionDialog>
    <ProgramAttachmentDialog></ProgramAttachmentDialog>
    <LeaveDeletionDialog></LeaveDeletionDialog>
    <LeaveEditDialog></LeaveEditDialog>
  </v-card>
</template>
<script>
import bus from 'bus'
import LeaveRequestList from './particles/LeaveRequestList'
import LeaveAdditionDialog from './dialogs/LeaveAdditionDialog'
import ProgramAttachmentDialog from './dialogs/ProgramAttachmentDialog'
import LeaveDeletionDialog from './dialogs/LeaveDeletionDialog'
import LeaveEditDialog from './dialogs/LeaveEditDialog'

export default {
  components: {
    LeaveRequestList,
    LeaveAdditionDialog,
    ProgramAttachmentDialog,
    LeaveDeletionDialog,
    LeaveEditDialog
  },
  computed: {

  },
  methods: {
    open_dialog_leave_addition () {
      bus.$emit('open_dialog_leave_addition')
    }
  }, 
  created () {
    this.$store.dispatch('leave/get_init', {
      student_id: this.$route.params.student_id
    }).then(res => {
      console.log('hi')
    })
  }
}
</script>