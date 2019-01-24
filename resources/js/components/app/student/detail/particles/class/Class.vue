<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Class</div>
      <v-spacer></v-spacer>
      <v-btn
        depressed
        color="primary"
        @click="open_dialog_program_addition()"
      >
        Add Program
      </v-btn>
    </v-card-title>
    <v-card-text>
      <ProgramBox
        v-for="program in available_programs"
        :key="'program_id:'+program.id"
        :program="program"
      ></ProgramBox>
      <!-- <template v-if="!_.isEmpty(class_groups)">
        <class-group 
          v-for="(group, i) in class_groups"
          :key="i"
          :group="group"
        >
        </class-group>
      </template> -->
      <!-- <template v-else>
        <div class="text-xs-center ca-typo-5 ca-typo-style-blank">
          There are no classes
        </div>
      </template> -->
      <NewProgramAdditionDialog></NewProgramAdditionDialog>
      <NewClassAdditionDialog></NewClassAdditionDialog>
      <ClassChangeDialog></ClassChangeDialog>
      <DateEditDialog></DateEditDialog>
      <ClassDeletionDialog></ClassDeletionDialog>
      <ProgramTermUpdateDialog></ProgramTermUpdateDialog>
      <ClassCompletionDialog></ClassCompletionDialog>
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
    // ClassGroup
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
  }
}
</script>