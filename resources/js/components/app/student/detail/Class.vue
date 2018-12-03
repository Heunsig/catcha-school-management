<template>
  <v-card>
    <v-card-title>
      <div class="ca-title-4">Classes</div>
      <v-spacer></v-spacer>
      <v-btn
        depressed
        color="primary"
        @click="new_class_addition_dialog = !new_class_addition_dialog"
      >
        Add Class
      </v-btn>
      <new-class-addition-dialog
        :is_active="new_class_addition_dialog"
        :classes="classes"
        @add_class="add_class($event)"
        @close="new_class_addition_dialog = false"
      ></new-class-addition-dialog>
    </v-card-title>
    <v-card-text>
      <div class="ca-class-group" v-for="(group, i) in class_groups">
        <template v-for="_class in group">
          <ca-class-item
            :key="_class.id"
            :group="group"
            :_class="_class"
            :fn_open_dialog="open_dialog_class_change"
            :fn_open_date_edit_dialog="open_dialog_date_edit"
            :fn_open_deletion_dialog="open_dialog_deletion"
          >
          </ca-class-item>
        </template>
      </div>
      <class-change-dialog
        :is_active="class_change_dialog"
        :classes="classes"
        :selected_classinfo="selected_classinfo"
        @move="move($event)"
        @close="class_change_dialog = false"
      >
      </class-change-dialog>
      <date-edit-dialog
        :is_active="date_edit_dialog"
        :start_date="start_date"
        :completion_date="completion_date"
        :selected_classinfo="selected_classinfo2"
        @edit="edit($event)"
        @close="date_edit_dialog = false"
      >
      </date-edit-dialog>
      <class-deletion-dialog
        :is_active="class_deletion_dialog"
        :selected_classinfo="selected_classinfo3"
        @del="del($event)"
        @close="class_deletion_dialog = false"
      >
      </class-deletion-dialog>
    </v-card-text>
  </v-card>
</template>
<script>
import NewClassAdditionDialog from './particles/class/NewClassAdditionDialog'
import ClassChangeDialog from './particles/class/ClassChangeDialog'
import CaClassItem from './particles/class/CaClassItem'
import DateEditDialog from './particles/class/DateEditDialog'
import ClassDeletionDialog from './particles/class/ClassDeletionDialog'

export default {
  components: {
    NewClassAdditionDialog,
    ClassChangeDialog,
    CaClassItem,
    DateEditDialog,
    ClassDeletionDialog
  },
  data () {
    return {
      new_class_addition_dialog: false,
      class_change_dialog: false,
      date_edit_dialog: false,
      class_deletion_dialog: false,
      selected_classinfo: {},
      selected_classinfo2: {},
      selected_classinfo3: {},
      selected_group: [],
      classes: [],
      class_groups: [],
      start_date: '',
      completion_date: ''
    }
  },
  methods: {
    open_dialog_class_change (class_obj, group) {
      this.selected_classinfo = class_obj
      this.selected_group = group
      this.class_change_dialog = true
    },
    open_dialog_date_edit (start_date, completion_date, class_obj, group) {
      this.start_date = start_date
      this.completion_date = completion_date
      this.selected_classinfo2 = class_obj
      this.selected_group = group
      this.date_edit_dialog = true
    },
    open_dialog_deletion (class_obj, group) {
      this.selected_classinfo3 = class_obj
      this.selected_group = group
      this.class_deletion_dialog = true
    },
    add_class (new_class) {
      this.class_groups.push([new_class])
    },
    edit (obj) {
      this.selected_group[this.selected_group.indexOf(obj.original_obj)] = obj.edited_obj
    },
    del (obj) {
      this.selected_group.splice(this.selected_group.indexOf(obj.original_obj), 1)
      if (!this.selected_group.length) {
        console.log('ddd', this.class_groups.indexOf(this.selected_group))
        this.class_groups.splice(this.class_groups.indexOf(this.selected_group), 1)
      }
    },
    move (obj) {
      // console.log(this.selected_group.indexOf(this.selected_classinfo))
      let index = this.selected_group.indexOf(this.selected_classinfo)
      this.selected_group[index] = obj.previous_obj
      this.selected_group.push(obj.new_obj)
    }
  },
  created () {
    this.$axios.get(`/class`).then(res => {
      console.log('res', res)
      this.classes = res.data
    })

    this.$axios.get(`/student/${this.$route.params.student_id}/class`).then(res => {
      console.log('student classes', res)
      let pure_data = res.data

      let filtered_data_arr = []
      for(let i in pure_data) {
        let filtered_itm = this._.filter(pure_data[i], {'deleted_at': null})
        if (!this._.isEmpty(filtered_itm)) {
          filtered_data_arr.push(filtered_itm)
        }
      }

      this.class_groups = filtered_data_arr
    })
  }
}
</script>