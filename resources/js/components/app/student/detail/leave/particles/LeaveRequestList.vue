<template>
  <v-container fluid class="pa-0 ca-grid-list-2-y">
    <v-layout wrap>
      <v-flex 
        xs12
        v-for="request in leave_requests"
        :key="request.id"
      >
        <v-card>
          <v-card-text>
            <div class="insty-leave-box">
              <div class="insty-leave-type">
                <span>{{ request.leave_type }}</span>
              </div>
              <v-spacer></v-spacer>
              <div>
                <span>{{ $moment(request.start_date).format('M/D/Y') }}</span>
                -
                <span>{{ $moment(request.completion_date).format('M/D/Y') }}</span>
              </div>
              <v-menu
                bottom left
              >
                <v-btn
                  slot="activator"
                  icon
                  small
                  @click=""
                >
                  <v-icon small>more_vert</v-icon>
                </v-btn>
                <v-list dense>
                  <v-list-tile @click="edit(request)">
                    <v-list-tile-title>Edit</v-list-tile-title>
                  </v-list-tile>
                  <v-list-tile @click="del(request)">
                    <v-list-tile-title>Remove</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu>
            </div>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import bus from 'bus'
export default {
  data () {
    return {
      menu: false
    }
  },
  computed: {
    leave_requests () {
      return this.$store.getters['leave/available_leave_requests']
    }
  },
  methods: {
    del (obj) {
      console.log('bb', obj)
      bus.$emit('open_dialog_leave_deletion', {
        leave_request: obj
      })
    },
    edit (obj) {
      bus.$emit('open_dialog_leave_edit', {
        leave_request: obj
      })
    }
  }
}
</script>
<style scoped>
  .insty-leave-box {
    display: flex;
    align-items: center;
  }
</style>