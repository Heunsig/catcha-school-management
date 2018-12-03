<template>
  <div class="ca-class" :class="status_color_style(_class)">
    <div class="ca-class-header">
      <div class="ca-title">
        <div class="ca-status">
          <div>{{ status(_class) }}</div>
        </div>
        <div class="ca-title-4">{{ _class.name }}</div>
        <div class="ca-meta">
          <div class="ca-tyop-meta mr-2">
            {{ _class.start_date }} - {{ _class.completion_date || 'Today' }} ({{ days(_class.start_date, _class.completion_date) }} days)
          </div>
          <v-btn class="ma-0" icon @click="fn_open_date_edit_dialog(_class.start_date, _class.completion_date, _class, group)">
            <v-icon small>edit</v-icon>
          </v-btn>
        </div>
      </div>
      <v-spacer></v-spacer>
      <div class="ca-action">
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
              <div class="ca-button-box">
                <v-btn
                  depressed
                  @click="fn_open_dialog(_class, group)"
                  :disabled="is_last() ? false:true"
                >
                  Move
                </v-btn>
                <v-btn
                  depressed
                  @click="fn_open_deletion_dialog(_class, group)"
                >
                  Delete
                </v-btn>
              </div>
              <v-divider></v-divider>
              <div class="ca-tracking-container">
                <div class="ca-tracking-box">
                  <div class="ca-tracking-box-title">Created By</div>
                  <div class="ca-tracking-box-avatar">
                    <v-tooltip bottom>
                      <v-avatar
                        slot="activator"
                        size="25"
                        color="grey lighten-4"
                      >
                        <img :src="AVATAR_BASE_URL + '/40/' + _class.created_by.full_name" alt="avatar">
                      </v-avatar>
                      <span>{{ _class.created_by.full_name }}</span>
                    </v-tooltip>
                  </div>
                </div>
                <div class="ca-tracking-box">
                  <div class="ca-tracking-box-title">Updated By</div>
                  <div class="ca-tracking-box-avatar">
                    <v-tooltip bottom>
                      <v-avatar
                        slot="activator"
                        size="25"
                        color="grey lighten-4"
                      >
                        <img :src="AVATAR_BASE_URL + '/40/' + _class.updated_by.full_name" alt="avatar">
                      </v-avatar>
                      <span>{{ _class.updated_by.full_name }}</span>
                    </v-tooltip>
                  </div>
                </div>
                <div class="ca-tracking-box">
                  <div class="ca-tracking-box-title">Deleted By</div>
                  <div class="ca-tracking-box-avatar">
                    <template v-if="_class.deleted_by">
                      <v-tooltip bottom>
                        <v-avatar
                          slot="activator"
                          size="25"
                          color="grey lighten-4"
                        >

                          <img :src="AVATAR_BASE_URL + '/40/' + _class.deleted_by.full_name" alt="avatar">
                        </v-avatar>
                        <span>{{ _class.deleted_by.full_name }}</span>
                      </v-tooltip>  
                    </template>
                    <template v-else>
                      <v-avatar
                          size="25"
                          color="grey lighten-4"
                        >
                        </v-avatar>
                    </template>
                  </div>
                </div>
              </div>
            </v-card-text>
          </v-card>
        </v-menu>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    group: Array,
    _class: Object,
    fn_open_dialog: Function,
    fn_open_date_edit_dialog: Function,
    fn_open_deletion_dialog: Function
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
        if (this.$moment(this.group[i].created_at.date).diff(this._class.created_at.date) > 0) {
          return false
        } else if (this.group[i].deleted_at) {
          return false
        }
      }
      return true
    },
    status (_class) {
      if (_class.deleted_at) {
        return 'Deleted'
      } else if (_class.completion_date) {
        return 'Completed'
      } else if (this.$moment().isBefore(_class.start_date)) {
        return 'Waiting'
      } else {
        return 'In progress'
      }
    },
    status_color_style (_class) {
      if (_class.deleted_at) {
        return 'ca-deleted'
      } else if (_class.completion_date) {
        return 'ca-completed'
      } else if (this.$moment().isBefore(_class.start_date)) {
        return 'ca-wating'
      } else {
        return 'ca-inprogress'
      }
    }
  }
}
</script>