<template>
  <v-card class="ca-dashboard-section elevation-0">
  <!-- <v-card> -->
    <v-card-title>
      <h5 class="ca-typo-title-5">Students who will begin programs</h5>
    </v-card-title>
    <v-card-text class="ca-dashboard-section-text">
    <!-- <v-card-text> -->
      <template v-if="_.isEmpty(coming_programs)">
        <div class="ca-dashboard-section-loading-box">
          <v-progress-circular
            indeterminate
            color="grey"
          ></v-progress-circular>
        </div>
      </template>
      <template v-else>
        <template v-if="!_.isEmpty(coming_programs.items)">
          <ul class="ca-simplified-list">
            <li
              class="ca-simplified-list-item"
              v-for="program in coming_programs.items"
            >
              <div class="ca-simplified-list-item-avatar">
                <v-tooltip bottom>
                  <v-avatar
                    slot="activator"
                    size="35"
                    color="grey lighten-4 ca-cursor-pointer"
                    @click="$router.push({name: 'student.information.basic_information', params: {student_id: program.student.id}})"
                  >
                    <img :src="AVATAR_BASE_URL+'/50/'+program.student.full_name" :alt="program.student.full_name"/>
                  </v-avatar>
                  <span>{{ program.student.full_name }}</span>
                </v-tooltip>
              </div>
              <div class="ca-simplified-list-item-info">
                <div>
                  <strong 
                    class="ca-cursor-pointer" 
                    @click="$router.push({name: 'student.class', params: {student_id: program.student.id}})"
                  >
                    {{ program.program.name }}
                  </strong>
                </div>
                <div>
                  <strong class="green--text lighten-1">
                    {{ $moment(program.start_date).format('MM/DD/YYYY') }}
                  </strong> 
                  <span>-</span> 
                  <span class="grey--text lighten-1">
                    {{ $moment(program.completion_date).format('MM/DD/YYYY') }}
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
          @click="open_dialog_for_extension()"
        >
          More
          <span class="ml-1">
          ({{ more }})
          </span>
        </v-btn>
      </template>
      <template v-else>
        <v-btn flat block color="orange" disabled>
          more
        </v-btn>
      </template>
    </v-card-actions>
    <ExtensionDialog></ExtensionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'

import ExtensionDialog from './ExtensionDialog'
export default {
  props:[
    'is_ready'
  ],
  components: {
    ExtensionDialog
  },  
  computed: {
    coming_programs () {
      return this.$store.getters['dashboard/coming_programs']
    },
    more () {
      return this.coming_programs.count ? parseInt(this.coming_programs.count):null
    }
  },
  methods: {
    open_dialog_for_extension () {
      bus.$emit('dialog:dashboard.full_coming_programs')
    }
  }
}
</script>