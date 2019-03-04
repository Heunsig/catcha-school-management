<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Program & Class</div>
      <v-spacer></v-spacer>
      <!-- <v-btn
        depressed
        color="primary"
        @click="open_dialog_program_addition()"
      >
        Add Program
      </v-btn> -->
    </v-card-title>
    <v-card-text>
      <template v-if="loading">
        <div class="ca-loading-box">
          <v-progress-circular
            indeterminate
            color="primary"
          ></v-progress-circular> 
        </div>
      </template>
      <template v-else>
        <template v-if="_.isEmpty(available_programs)">
          <div class="ca-nodata-box">
            <div class="ca-nodata-box__message">
              <v-icon>sentiment_very_dissatisfied</v-icon>
              <div class="message">Nothing to see here</div>
            </div>
          </div>
        </template>
        <template v-else>
          <ProgramBox
            v-for="program in available_programs"
            :key="'program_id:'+ program.id"
            :program="program"
          ></ProgramBox>
        </template>
      </template>
      
      <NewProgramAdditionDialog></NewProgramAdditionDialog>
      <NewClassAdditionDialog></NewClassAdditionDialog>
      <ClassChangeDialog></ClassChangeDialog>
      <DateEditDialog></DateEditDialog>
      <ClassDeletionDialog></ClassDeletionDialog>
      <ProgramTermUpdateDialog></ProgramTermUpdateDialog>
      <ClassCompletionDialog></ClassCompletionDialog>
      <ProgramTermHistoryDialog></ProgramTermHistoryDialog>
      <InitProgramTermSetDialog></InitProgramTermSetDialog>
      <ProgramResetDialog></ProgramResetDialog>
    </v-card-text>
  </v-card>
</template>
<script>
import bus from 'bus'

import NewProgramAdditionDialog from './NewProgramAdditionDialog'
import NewClassAdditionDialog from './NewClassAdditionDialog'
import ClassChangeDialog from './ClassChangeDialog'
import DateEditDialog from './DateEditDialog'
import ClassDeletionDialog from './ClassDeletionDialog'
import ProgramTermUpdateDialog from './ProgramTermUpdateDialog'
import ClassCompletionDialog from './ClassCompletionDialog'
import ProgramTermHistoryDialog from './ProgramTermHistoryDialog'
import InitProgramTermSetDialog from './InitProgramTermSetDialog'
import ProgramResetDialog from './ProgramResetDialog'

import ProgramBox from './list/ProgramBox'

// import ClassGroup from './list/ClassGroup'

export default {
  components: {
    NewProgramAdditionDialog,
    NewClassAdditionDialog,
    ClassChangeDialog,
    DateEditDialog,
    ClassDeletionDialog,
    ProgramTermUpdateDialog,
    ClassCompletionDialog,
    ProgramBox,
    ProgramTermHistoryDialog,
    InitProgramTermSetDialog,
    ProgramResetDialog
    // ClassGroup
  },
  data () {
    return {
      loading: false
    }
  },
  computed: {
    programs () {
      return this.$store.getters['class/programs']
    },
    available_programs () {
      let original_arr = _.clone(this.programs)
      return _.filter(original_arr, function(value){
        return value.administration.deleted_at === null
      })
    }
    // reversed_class_group () {
    //   let reversed_groups = this._.reverse(this._.clone(this.class_groups))
    //   return reversed_groups
    // },
    // class_groups () {
    //   return this.$store.getters['class/class_groups']
    // }
  },
  methods: {
    open_dialog_program_addition () {
      bus.$emit('open_dialog_program_addition')
    }
  },
  created () {
    this.loading = true
    this.$store.dispatch('class/get_class_page', this.$route.params.student_id).then(res => {
      this.loading = false
    })
  }
}
</script>