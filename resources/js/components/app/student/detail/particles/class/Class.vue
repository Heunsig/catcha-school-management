<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-4">Class</div>
      <v-spacer></v-spacer>
      <v-btn
        depressed
        color="primary"
        @click="open_dialog_class_addition()"
      >
        Add Class
      </v-btn>
      <new-class-addition-dialog></new-class-addition-dialog>
    </v-card-title>
    <v-card-text>
      <template v-if="!_.isEmpty(class_groups)">
        <class-group 
          v-for="(group, i) in class_groups"
          :key="i"
          :group="group"
        >
        </class-group>
      </template>
      <template v-else>
        <div class="text-xs-center ca-typo-5 ca-typo-style-blank">
          There are no classes
        </div>
      </template>
      <ClassChangeDialog></ClassChangeDialog>
      <DateEditDialog></DateEditDialog>
      <ClassDeletionDialog></ClassDeletionDialog>
    </v-card-text>
  </v-card>
</template>
<script>
import bus from 'bus'

import NewClassAdditionDialog from './NewClassAdditionDialog'
import ClassChangeDialog from './ClassChangeDialog'
import DateEditDialog from './DateEditDialog'
import ClassDeletionDialog from './ClassDeletionDialog'

import ClassGroup from './list/ClassGroup'

export default {
  components: {
    NewClassAdditionDialog,
    ClassChangeDialog,
    DateEditDialog,
    ClassDeletionDialog,
    ClassGroup
  },
  computed: {
    reversed_class_group () {
      let reversed_groups = this._.reverse(this._.clone(this.class_groups))
      return reversed_groups
    },
    class_groups () {
      return this.$store.getters['class/class_groups']
    }
  },
  methods: {
    open_dialog_class_addition () {
      bus.$emit('open_dialog_class_addition')
    },
  }
}
</script>