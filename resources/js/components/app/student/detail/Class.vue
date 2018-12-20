<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-2">Classes</div>
      <v-spacer></v-spacer>
      <v-btn
        depressed
        color="primary"
        @click="open_dialog_class_addition()"
      >
        Add Class
      </v-btn>
      <new-class-addition-dialog
        :classes="classes"
        @submit="add_new_class($event)"
      ></new-class-addition-dialog>
    </v-card-title>
    <v-card-text>
      <class-group 
        v-for="(group, i) in class_groups"
        :key="i"
        :group="group"
      >
      </class-group>
      <class-change-dialog
        :classes="classes"
        @submit="change_class($event)"
      >
      </class-change-dialog>
      <date-edit-dialog
        @submit="edit_date($event)"
      >
      </date-edit-dialog>
      <class-deletion-dialog
        @submit="del_class($event)"
      >
      </class-deletion-dialog>
    </v-card-text>
  </v-card>
</template>
<script>
import bus from 'bus'

import NewClassAdditionDialog from './particles/class/NewClassAdditionDialog'
import ClassChangeDialog from './particles/class/ClassChangeDialog'
import DateEditDialog from './particles/class/DateEditDialog'
import ClassDeletionDialog from './particles/class/ClassDeletionDialog'

import ClassGroup from './particles/class/list/ClassGroup'

export default {
  components: {
    NewClassAdditionDialog,
    ClassChangeDialog,
    DateEditDialog,
    ClassDeletionDialog,
    ClassGroup
  },
  data () {
    return {
      classes: [],
      class_groups: []
    }
  },
  methods: {
    open_dialog_class_addition () {
      bus.$emit('open_dialog_class_addition')
    },
    add_new_class (payload) {
      this.$axios.post(`/student/${this.$route.params.student_id}/class`, {
        classinfo_id: payload.classinfo_id,
        start_date: payload.start_date
      }).then(res => {
        console.log('res s', res)
        this.class_groups.push([res.data])
      })
    },
    edit_date (payload) {
      this.$axios.post(`/student/${this.$route.params.student_id}/class/edit_date`, {
        student_class_id: payload.selected_class_item.id,
        start_date: payload.start_date,
        completion_date: payload.completion_date
      }).then(res => {
        let item_index = payload.selected_group.indexOf(payload.selected_class_item)
        this.$set(payload.selected_group, item_index, res.data)
      })
    },
    del_class (payload) {
      // 
      // Need to modify because if a client uses filtered mode, classes which are deleted should
      // be deleted. However, if a client uses non-filtered mode, classes which are deleted should
      // be shown up on the page.
      // 
      this.$axios.post(`/student/${this.$route.params.student_id}/class/delete`,{
        student_class_id: payload.selected_class_item.id
      }).then(res => {
        let item_index = payload.selected_group.indexOf(payload.selected_class_item)
        payload.selected_group.splice(item_index, 1)
        if (!payload.selected_group.length) {
          this.class_groups.splice(this.class_groups.indexOf(payload.selected_group), 1)
        }
      })
    },
    change_class (payload) {
      this.$axios.post(`/student/${this.$route.params.student_id}/change_class`, {
        classinfo_id: payload.classinfo_id,
        start_date: payload.start_date,
        selected_student_class_id: payload.selected_class_item.id,
        selected_student_class_group: payload.selected_class_item.group
      }).then(res => {
        let original_item_index = payload.selected_group.indexOf(payload.selected_class_item)
        this.$set(payload.selected_group, original_item_index, res.data.original_class)
        payload.selected_group.push(res.data.new_class)
      })
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
      // this.class_groups = pure_data
    })

  }
}
</script>