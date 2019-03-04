<template>
  <v-card>
    <v-card-title>
      <span>Students who is going to start programs in this week</span>
    </v-card-title>
    <v-card-text>
      <ul class="ca-simplified-list">
        <li 
          class="ca-simplified-list-item"
          v-for="program in coming_programs.items"
        >
          <div class="ca-simplified-list-item-avatar">
            <v-tooltip bottom>
              <v-avatar
                slot="activator"
                size="45"
                color="grey lighten-4 ca-cursor-pointer"
                @click="$router.push({name: 'student.basic_information', params: {student_id: program.student.id}})"
              >
                <img :src="AVATAR_BASE_URL+'/50/'+program.student.full_name" :alt="program.student.full_name"/>
              </v-avatar>
              <span>{{ program.student.full_name }}</span>
            </v-tooltip>
          </div>
          <div class="ca-simplified-list-item-info">
            <div><strong class="insty-program ca-cursor-pointer" @click="$router.push({name: 'student.class', params: {student_id: program.student.id}})">{{ program.program.name }}</strong></div>
            <div><span class="green--text lighten-1">{{ $moment(program.start_date).format('MM/DD/YYYY') }}</span> <span>-</span> <span class="grey--text lighten-1">{{ $moment(program.completion_date).format('MM/DD/YYYY') }}</span></div>
          </div>
        </li>
      </ul>
    </v-card-text>
    <v-card-actions>
      <v-btn 
        flat 
        block 
        color="orange"
        @click="open_dialog_for_extension()"
      >
        More<span v-if="coming_programs.count" class="ml-1">(+ {{ parseInt(coming_programs.count) - coming_programs.items.length }})</span>
      </v-btn>
    </v-card-actions>
    <ComingProgramExtensionDialog></ComingProgramExtensionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'

import ComingProgramExtensionDialog from './dialogs/ComingProgramExtensionDialog'
export default {
  components: {
    ComingProgramExtensionDialog
  },  
  computed: {
    coming_programs () {
      return this.$store.getters['dashboard/coming_programs']
    }
  },
  methods: {
    open_dialog_for_extension () {
      bus.$emit('open_dialog_for_extension')
    }
  }
}
</script>