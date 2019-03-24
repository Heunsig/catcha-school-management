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
      
      <Dialog_AddNewProgram></Dialog_AddNewProgram>
      <Dialog_AddNewClass></Dialog_AddNewClass>
      <Dialog_ChageClass></Dialog_ChageClass>
      <Dialog_EditDate></Dialog_EditDate>
      <Dialog_DeleteClass></Dialog_DeleteClass>
      <Dialog_UpdateProgramTerm></Dialog_UpdateProgramTerm>
      <Dialog_CompleteClass></Dialog_CompleteClass>
      <Dialog_ShowProgramTermHistory></Dialog_ShowProgramTermHistory>
      <Dialog_InitProgramTerm></Dialog_InitProgramTerm>
      <Dialog_ResetProgram></Dialog_ResetProgram>
    </v-card-text>
  </v-card>
</template>
<script>
import bus from 'bus'

import Dialog_AddNewProgram from './dialogs/Dialog_AddNewProgram'
import Dialog_AddNewClass from './dialogs/Dialog_AddNewClass.vue'
import Dialog_ChageClass from './dialogs/Dialog_ChageClass'
import Dialog_EditDate from './dialogs/Dialog_EditDate'
import Dialog_DeleteClass from './dialogs/Dialog_DeleteClass'
import Dialog_UpdateProgramTerm from './dialogs/Dialog_UpdateProgramTerm'
import Dialog_CompleteClass from './dialogs/Dialog_CompleteClass'
import Dialog_ShowProgramTermHistory from './dialogs/Dialog_ShowProgramTermHistory'
import Dialog_InitProgramTerm from './dialogs/Dialog_InitProgramTerm'
import Dialog_ResetProgram from './dialogs/Dialog_ResetProgram'

import ProgramBox from './list/ProgramBox'

export default {
  components: {
    Dialog_AddNewProgram,
    Dialog_AddNewClass,
    Dialog_ChageClass,
    Dialog_EditDate,
    Dialog_DeleteClass,
    Dialog_UpdateProgramTerm,
    Dialog_CompleteClass,
    Dialog_ShowProgramTermHistory,
    Dialog_InitProgramTerm,
    Dialog_ResetProgram,
    ProgramBox
  },
  data () {
    return {
      loading: false
    }
  },
  computed: {
    programs () {
      return this.$store.getters['student/class/programs']
    },
    available_programs () {
      let original_arr = _.clone(this.programs)
      return _.filter(original_arr, function(value){
        return value.administration.deleted_at === null
      })
    }
  },
  methods: {
    open_dialog_program_addition () {
      bus.$emit('open_dialog_program_addition')
    }
  },
  created () {
    this.loading = true
    // this.$store.dispatch('class/get_class_page', this.$route.params.student_id).then(res => {
    this.$store.dispatch('student/class/get_class_page', this.$route.params.student_id).then(res => {
      this.loading = false
    })
  }
}
</script>