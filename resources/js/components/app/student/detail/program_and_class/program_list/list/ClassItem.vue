<template>
  <div class="insty-class" :class="get_status_style">
    <div class="insty-class-name">
      <div>
        <span class="__status">{{ get_status }}</span>
      </div>
      <div>
        <span>{{ class_item.name }}</span>
      </div>
    </div>
    <v-spacer></v-spacer>
    <div class="insty-right">
      <div class="insty-date">
        <span>{{ $moment(class_item.start_date).format('M/D/Y') }}</span>
        <template v-if="class_item.completion_date">
          <span>-</span> <span>{{ $moment(class_item.completion_date).format('M/D/Y') }}</span>
        </template>
      </div>
      <div class="insty-actions">
        <v-menu bottom left>
          <v-btn
            slot="activator"
            icon
            small
            @click=""
          >
            <v-icon small>more_vert</v-icon>
          </v-btn>
          <v-list dense>
            <v-list-tile @click="open_dialog_class_change()" v-if="is_last">
              <v-list-tile-title>Change Class</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="open_dialog_class_completion()" v-if="!is_completed">
                <v-list-tile-title>Complete Class</v-list-tile-title>
              </v-list-tile>
            <v-list-tile @click="open_dialog_date_edit()">
              <v-list-tile-title>Edit dates</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="del()">
              <v-list-tile-title>Remove</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </div>
    </div>
  </div>
</template>
<script>
import bus from 'bus'
export default {
  props: {
    program: Object,
    class_item: Object
  },
  computed: {
    available_classes () {
      return this.$store.getters['student/class/available_classes'](this.program)
    },
    get_status () {
      if (this.class_item.deleted_at) {
        return 'Deleted'
      } else if (this.class_item.completion_date) {
        return 'Completed'
      } else if (this.$moment().isBefore(this.class_item.start_date)) {
        return 'Waiting'
      } else {
        return 'In progress'
      }
    },
    get_status_style () {
      if (this.class_item.deleted_at) {
        return 'ca-deleted'
      } else if (this.class_item.completion_date) {
        return 'ca-completed'
      } else if (this.$moment().isBefore(this.class_item.start_date)) {
        return 'ca-wating'
      } else {
        return 'ca-inprogress'
      }
    },
    is_last () {
      return this.available_classes.length === this.available_classes.indexOf(this.class_item) + 1
    },
    is_completed () {
      return this.class_item.completion_date !== null
    }
  },
  methods: {
    open_dialog_class_change () {
      bus.$emit('open_dialog_class_change', {
        program: this.program,
        class_item: this.class_item
      })
    },
    open_dialog_date_edit () {
      bus.$emit('open_dialog_date_edit', {
        start_date: this.class_item.start_date,
        completion_date: this.class_item.completion_date,
        class_item: this.class_item
      })
    },
    open_dialog_class_completion () {
      bus.$emit('open_dialog_class_completion', {
        class_item: this.class_item
      })
    },
    del () {
      this.$store.dispatch('student/class/del_class', {
        class_in_program_id: this.class_item.id
      })
    },
  }
}  
</script>
<style scoped>
  .insty-class {
    display: flex;
    padding: 15px;
    margin: 8px 0;
    box-shadow: 0px 1px 1px 0px #d2d2d2;
    border-right: 1px solid #bcbcbc;
    border-bottom: 1px solid #bcbcbc;
    align-items: center;
  }

  .insty-right {
    display: flex;
    align-items: center;
  }
</style>