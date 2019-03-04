<template>
  <v-card class="ca-dashboard-section">
    <v-card-title>
      <h5 class="ca-typo-title-5">Students who will take leaves</h5>
    </v-card-title>
    <v-card-text class="ca-dashboard-section-text">
      <template v-if="_.isEmpty(coming_leaves)">
        <div class="ca-dashboard-section-loading-box">
          <v-progress-circular
            indeterminate
            color="grey"
          ></v-progress-circular>
        </div>
      </template>
      <template v-else>
        <template v-if="!_.isEmpty(coming_leaves.items)">
          <ul class="ca-simplified-list">
            <li 
              class="ca-simplified-list-item"
              v-for="leave in coming_leaves.items"
            >
              <div class="ca-simplified-list-item-avatar">
                <v-tooltip bottom>
                  <v-avatar
                    slot="activator"
                    size="35"
                    color="grey lighten-4 ca-cursor-pointer"
                    @click="$router.push({name: 'student.information.basic_information', params: {student_id: leave.student.id}})"
                  >
                    <img :src="AVATAR_BASE_URL+'/50/'+leave.student.full_name" :alt="leave.student.full_name"/>
                  </v-avatar>
                  <span>{{ leave.student.full_name }}</span>
                </v-tooltip>
              </div>
              <div class="ca-simplified-list-item-info">
                <div><strong>{{ leave.leave_type }}</strong></div>
                <div>
                  <strong class="green--text lighten-1">
                    {{ $moment(leave.start_date).format('MM/DD/YYYY') }}
                  </strong> 
                  <span>-</span>
                  <span class="grey--text lighten-1">
                    {{ $moment(leave.completion_date).format('MM/DD/YYYY') }}
                  </span>
                </div>
              </div>
            </li>
          </ul>
        </template>
        <template v-else>
          <div class="ca-dashboard-section-noinfo text-xs-center">
            <span class="ca-typo-title-5">No Student</span>
          </div>
        </template>
      </template>
    </v-card-text>
    <v-card-actions>
      <template v-if="more">
        <v-btn 
          flat 
          block 
          color="orange"
          @click="open_dialog_for_coming_leaves_extension()"
        >
          More
          <span class="ml-1">
          ({{ more }})
          </span>
        </v-btn>
      </template>
      <template v-else>
        <v-btn flat block color="orange" disabled>
          More
        </v-btn>
      </template>
      <!-- <v-btn 
        flat 
        block 
        color="orange"
        @click="open_dialog_for_coming_leaves_extension()"
      >
        More<span v-if="coming_leaves.count" class="ml-1">(+ {{ parseInt(coming_leaves.count) - coming_leaves.items.length }})</span>
      </v-btn> -->
    </v-card-actions>
    <ExtensionDialog></ExtensionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'

import ExtensionDialog from './ExtensionDialog'
export default {
  props: [
    'is_ready'
  ],
  components: {
    ExtensionDialog
  },
  computed: {
    coming_leaves () {
      return this.$store.getters['dashboard/coming_leaves']
    },
    more () {
      return this.coming_leaves.count ? this.coming_leaves.count : null
    }
  },
  methods: {
    open_dialog_for_coming_leaves_extension () {
      bus.$emit('open_dialog_for_coming_leaves_extension')
    }
  }
}
</script>