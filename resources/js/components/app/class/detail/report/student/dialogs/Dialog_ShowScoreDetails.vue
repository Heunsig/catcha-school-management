<template>
  <v-dialog v-model="is_active" persistent scrollable max-width="1200">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">{{ student.full_name }}</h4>
      </v-card-title>
      <v-card-text>
        <v-container fluid class="pa-0 ca-grid-list-3">
          <v-layout wrap>
            <v-flex xs2>
              <v-list>
                <v-list-tile 
                  v-for="group in grade_groups" 
                  :key="group.id"
                  @click="apple(group)"
                >
                  <v-list-tile-content>
                    <v-list-tile-title>{{ group.name }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-flex>
            <v-flex xs10>
              <ReportSection
                :grade_group_name="grade_group_name"
                :grade_group_id="grade_group_id"
                :scores="scores"
                :from="from"
                :to="to"
              ></ReportSection>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="grey darken-2" @click="is_active = false">
          Close
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'

import ReportSection from './particles/ReportSection'
export default {
  props: [
    'from',
    'to'
  ],
  components: {
    ReportSection
  },
  data () {
    return {
      is_active: false,
      student: {},
      scores: {},
      grade_group_id: 1,
      grade_group_name: 'Attendance'
    }
  },
  computed: {
    // from () {
    //   return this.$route.query.from || this.$moment().format('Y-MM-DD')
    // },  
    // to () {
    //   return this.$route.query.to || this.$moment().format('Y-MM-DD')
    // },
    grade_groups () {
      return this.$store.getters['class/grade_groups']
    }
  },
  watch: {
    is_active (new_v) {
      if (!new_v) {

      } else {
        this.$axios.get(`grade_score/class/${this.$route.params.classinfo_id}/report/group_by/student/${this.student.id}/from/${this.from}/to/${this.to}`).then(res => {
          console.log('hihihi', res)
          this.scores = res.data
        })
      }
    }
  },
  methods: {
    apple (grade_group) {
      this.grade_group_id = grade_group.id
      this.grade_group_name = grade_group.name
    }
  },
  created () {
    bus.$on('dialog:show_score_details', payload => {
      this.is_active = true
      this.student = payload.student
    })
  }
}
</script>