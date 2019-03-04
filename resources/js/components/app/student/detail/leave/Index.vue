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
            <template v-if="loading">
              <div class="ca-loading-box">
                <v-progress-circular
                  indeterminate
                  color="primary"
                ></v-progress-circular> 
              </div>
            </template>
            <template v-else>
              <template v-if="_.isEmpty(leave_requests)">
                <div class="ca-nodata-box">
                  <div class="ca-nodata-box__message">
                    <v-icon>sentiment_very_dissatisfied</v-icon>
                    <div class="message">Nothing to see here</div>
                  </div>
                </div>
              </template>
              <template>
                <LeaveRequestList></LeaveRequestList>
              </template>
            </template>
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
  data () {
    return {
      loading: false
    }
  },
  computed: {
    leave_requests () {
      return this.$store.getters['leave/available_leave_requests']
    }
  },
  methods: {
    open_dialog_leave_addition () {
      bus.$emit('open_dialog_leave_addition')
    }
  }, 
  created () {
    this.loading = true
    this.$store.dispatch('leave/get_init', {
      student_id: this.$route.params.student_id
    }).then(res => {
      console.log('hi')
      this.loading = false
    })
  }
}
</script>