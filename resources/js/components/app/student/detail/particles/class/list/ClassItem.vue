<template>
  <div class="ca-student-class-item" :class="get_status_style(item)">
    <div class="__header">
      <div class="__title-box">
        <div class="__status">
          {{ get_status(item) }}
        </div>
        <div class="__title ca-typo-title-4">{{ item.name }}</div>
        <div class="__date-box">
          <div class="__date ca-typo-meta mr-2">
            {{ item.start_date }} - {{ item.completion_date || 'Today' }} ({{ days(item.start_date, item.completion_date) }} days)
          </div>
          <div class="__action">
            <v-btn class="ma-0" icon @click="open_dialog_date_edition(item.start_date, item.completion_date, item, group)">
              <v-icon small>edit</v-icon>
            </v-btn>
          </div>
        </div>
      </div>
      <v-spacer></v-spacer>
      <div class="__action-box">
        <v-menu
          v-model="menu"
          :close-on-content-click="false"
          offset-y
          top
          z-index="2"
        >
          <v-btn
            slot="activator"
            icon
          >
            <v-icon color="blue darken-2">build</v-icon>
          </v-btn>
          <v-card>
            <v-card-text>
              <div class="ca-menu-action">
                <v-btn
                  depressed
                  @click="open_dialog_class_change(item, group)"
                  :disabled="is_last() ? false:true"
                >
                  Change
                </v-btn>
                <v-btn
                  depressed
                  @click="open_dialog_deletion(item, group)"
                >
                  Delete
                </v-btn>
              </div>
              <v-divider></v-divider>
              <tracking-box
                :item="item"
              ></tracking-box>
            </v-card-text>
          </v-card>
        </v-menu>        
      </div>
    </div>
  </div>
</template>
<script>
import bus from 'bus'
import TrackingBox from './TrackingBox'

export default {
  components: {
    TrackingBox
  },
  props: {
    item: Object,
    group: Array
  },
  data: () => ({
    menu: false
  }),
  methods: {
    days (start_date, completion_date) {
      var a = this.$moment(start_date);
      var b = completion_date ? this.$moment(completion_date) : this.$moment();
      return b.diff(a, 'days') + 1
    },
    is_last () {
      for (let i in this.group) {
        if (this.$moment(this.group[i].created_at.date).diff(this.item.created_at.date) > 0) {
          return false
        } else if (this.group[i].deleted_at) {
          return false
        }
      }
      return true
    },
    get_status (item) {
      if (item.deleted_at) {
        return 'Deleted'
      } else if (item.completion_date) {
        return 'Completed'
      } else if (this.$moment().isBefore(item.start_date)) {
        return 'Waiting'
      } else {
        return 'In progress'
      }
    },
    get_status_style (item) {
      if (item.deleted_at) {
        return '_deleted'
      } else if (item.completion_date) {
        return '_completed'
      } else if (this.$moment().isBefore(item.start_date)) {
        return '_wating'
      } else {
        return '_inprogress'
      }
    },
    open_dialog_date_edition (start_date, completion_date, item, group) {
      bus.$emit('open_dialog_date_edition', {
        start_date: start_date,
        completion_date: completion_date,
        item: item,
        group: group
      })
    },
    open_dialog_class_change (item, group) {
      bus.$emit('open_dialog_class_change', {
        selected_class_item: item,
        selected_group: group
      })
    },
    open_dialog_deletion (item, group) {
      bus.$emit('open_dialog_deletion', {
        selected_class_item: item,
        selected_group: group
      })
    }
  }
}
</script>