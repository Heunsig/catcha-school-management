<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            <h4 class="ca-typo-title-4">Students</h4>
          </v-card-title>
          <v-card-text>
            <v-list>
              <v-list-tile
                v-for="(student, i) in students"
                :key="student.id+'_'+i"
                avatar
                @click="$router.push({
                  name: 'student.information.basic_information',
                  params: {
                    student_id: student.id
                  }
                })"
              >
                <v-list-tile-avatar>
                  <img :src="AVATAR_BASE_URL+'/50/'+student.full_name" :alt="student.full_name"/>
                </v-list-tile-avatar>
                <v-list-tile-content>
                  <v-list-tile-title>
                    {{ student.full_name }}
                  </v-list-tile-title>
                  <v-list-tile-sub-title>
                    <span>{{ $moment(student.start_date).format('MM/DD/Y') }}</span>
                    <span> ~ </span>
                    <span>Today ({{ $moment().format('MM/DD/Y') }}) </span>
                  </v-list-tile-sub-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-chip v-if="is_on_leave(student.leaves)" small color="grey" text-color="white">Vacation</v-chip>
                  <v-chip v-if="get_weeks(student.start_date) < 1" small color="green" text-color="white">New Student</v-chip>
                </v-list-tile-action>
              </v-list-tile>
            </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  computed: {
    students () {
      return this.$store.getters['class/classinfo'].students
    }
  },
  methods: {
    get_weeks (start_date) {
      let m_start_date = this.$moment(start_date)
      let m_today = this.$moment()
      let weeks = m_today.diff(m_start_date, 'weeks')

      return weeks
    },
    is_on_leave (leaves) {
      // console.log('le', leaves)
      let today = this.$moment()

      for (let i = 0 ; i < leaves.length ; i++) {
        if ( today.isAfter(this.$moment(leaves[i].start_date), 'date') &&
            today.isBefore(this.$moment(leaves[i].completion_date), 'date')) 
        {
          // console.log('hi', leaves[i])
          // break
          return true
        }
      }
    }
  }
}
</script>