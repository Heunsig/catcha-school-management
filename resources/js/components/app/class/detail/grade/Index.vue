<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <v-card>
          <v-card-text>
            Grade
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs3>
        <v-card>
          <v-card-title>
            <h4 class="ca-typo-title-4">Subjects</h4>
          </v-card-title>
          <v-card-text>
            <v-list-tile
              v-for="subject in subjects"
              :key="subject.title"
              @click=""
            >
              <v-list-tile-content>
                <v-list-tile-title v-text="subject.name"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs9>
        <v-card>
          <v-card-title>
            <h4></h4>
            <v-spacer></v-spacer>
            <div>{{ date }}</div>
          </v-card-title>
          <v-card-text>
            <table class="insty-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th v-for="group in grade_groups">
                    {{ group.name }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in students">
                  <td>{{ student.full_name }}</td>
                  <td v-for="group in grade_groups">
                    <template v-if="group.id === 1">
                      <Attendance
                        :student_id="student.id"
                        :grade_group_id="group.id"
                        :classinfo_id="$route.params.classinfo_id"
                        :subject_id="$route.params.subject_id"
                        :date="date"
                        :score2="get_score(student.id, group.id)"
                      ></Attendance>
                    </template>
                    <template v-else>
                      <ScoreField
                        :student_id="student.id"
                        :grade_group_id="group.id"
                        :classinfo_id="$route.params.classinfo_id"
                        :subject_id="$route.params.subject_id"
                        :date="date"
                        :score2="get_score(student.id, group.id)"
                      >
                      </ScoreField>
                    </template>
                  </td>
                </tr>
              </tbody>
            </table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import Attendance from './Attendance'
import ScoreField from './ScoreField'
export default {
  components: {
    Attendance,
    ScoreField
  },
  data () {
    return {
      form: [],
      test: '',
      date: '',
      scores: {}
    }
  },
  computed: {
    students () {
      return this.$store.getters['class/students']
    },
    subjects () {
      return this.$store.getters['class/subjects']
    },
    grade_groups () {
      return this.$store.getters['class/grade_groups']
    }
  },
  methods: {
    get_score (student_id, grade_group_id) {
      let a = this._.find(this.scores[student_id], {'grade_group_id': grade_group_id}) || {}
      if (typeof a.score !== 'undefined') {
        return a.score.toString()
      } else {
        return ''
      }
    }
  },
  created () {
    this.date = this.$moment(this.$route.params.date).format('MM/DD/Y')

    this.$axios.get(`grade_score/class/${this.$route.params.classinfo_id}/subject/${this.$route.params.subject_id}/date/${this.$moment(this.date, 'MM/DD/Y').format('YYYY-MM-DD')}`).then(res => {
      console.log('res', res)
      this.scores = res.data
    })
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
  }
</style>