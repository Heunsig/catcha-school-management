<template>
  <v-card>
    <v-card-title>
      <span>Students who would start vacations</span>
    </v-card-title>
    <v-card-text>
      <ul class="ca-simplified-list">
        <li 
          class="ca-simplified-list-item"
          v-for="leave in coming_leaves.items"
        >
          <div class="ca-simplified-list-item-avatar">
            <v-tooltip bottom>
              <v-avatar
                slot="activator"
                size="45"
                color="grey lighten-4 ca-cursor-pointer"
                @click="$router.push({name: 'student.basic_information', params: {student_id: leave.student.id}})"
              >
                <img :src="AVATAR_BASE_URL+'/50/'+leave.student.full_name" :alt="leave.student.full_name"/>
              </v-avatar>
              <span>{{ leave.student.full_name }}</span>
            </v-tooltip>
          </div>
          <div class="ca-simplified-list-item-info">
            <div><strong>{{ leave.leave_type }}</strong></div>
            <div><span style="color:green;">{{ $moment(leave.start_date).format('MM/DD/YYYY') }}</span> - <span>{{ $moment(leave.completion_date).format('MM/DD/YYYY') }}</span></div>
          </div>
        </li>
      </ul>
    </v-card-text>
    <v-card-actions>
      <v-btn 
        flat 
        block 
        color="orange"
        @click="open_dialog_for_coming_leaves_extension()"
      >
        More<span v-if="coming_leaves.count" class="ml-1">(+ {{ parseInt(coming_leaves.count) - coming_leaves.items.length }})</span>
      </v-btn>
    </v-card-actions>
    <ComingLeaveExtensionDialog></ComingLeaveExtensionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'

import ComingLeaveExtensionDialog from './dialogs/ComingLeaveExtensionDialog'
export default {
  components: {
    ComingLeaveExtensionDialog
  },
  computed: {
    coming_leaves () {
      return this.$store.getters['dashboard/coming_leaves']
    }
  },
  methods: {
    open_dialog_for_coming_leaves_extension () {
      bus.$emit('open_dialog_for_coming_leaves_extension')
    }
  }
}
</script>