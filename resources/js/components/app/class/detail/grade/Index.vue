<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <ul class="insty-ul">
          <li 
            v-for="subject in subjects" 
            class="ca-cursor-pointer"
            @click="$router.push({
              name: 'class.grade', 
              params: {subject_id: subject.id}, 
              query: {date: $route.query.date}
            })"
          >
            {{ subject.name }}
          </li>
        </ul>
      </v-flex>
      <v-flex xs12>
        <v-card>
          <v-card-title>
            <h4 v-if="!_.isEmpty(subjects)">
              {{ current_subject.name }}   
            </h4>
            <v-spacer></v-spacer>
            <div>
              <DatePicker
                :date="date"
              ></DatePicker>
            </div>
          </v-card-title>
          <v-card-text>
            <table class="insty-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th v-for="group in grade_groups" style="width:200px;">
                    {{ group.name }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <template v-for="student in students">
                  <GradeFormForStudent
                    :key="'grade_form_'+student.id"
                    :scores="scores"
                    :student="student"
                    :date="date"
                  ></GradeFormForStudent>
                </template>
                <!-- <tr v-for="student in students">
                  <td>
                    {{ student.full_name }}
                  </td>
                  <td v-for="group in grade_groups">
                    <template v-if="group.id === 1">
                      <Attendance
                        :key="'test' + group.id"
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
                        :key="'good' + group.id"
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
                </tr> -->
              </tbody>
            </table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
// import Attendance from './Attendance'
// import ScoreField from './ScoreField'
import GradeFormForStudent from './particles/GradeFormForStudent'
import DatePicker from './DatePicker'
export default {
  components: {
    // Attendance,
    // ScoreField,
    GradeFormForStudent,
    DatePicker
  },
  data () {
    return {
      scores: {},
    }
  },
  computed: {
    current_subject () {
      return _.find(this.subjects, { 'id': parseInt(this.$route.params.subject_id) })
    },
    date () {
      if (this.$route.query.date) {
        return this.$moment(this.$route.query.date).format('MM/DD/Y')  
      }

      return this.$moment().format('MM/DD/Y')
    },
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
    // get_score (student_id, grade_group_id) {
    //   let a = this._.find(this.scores[student_id], {'grade_group_id': grade_group_id}) || {}
    //   console.log(typeof a.score, a.score)
    //   if (typeof a.score !== 'undefined' && a.score !== null) {
    //     return a.score.toString()
    //   } else {
    //       return ''  
    //   }
    // }
  },
  created () {
    this.$axios.get(`grade_score/class/${this.$route.params.classinfo_id}/subject/${this.$route.params.subject_id}/date/${this.$moment(this.date, 'MM/DD/Y').format('YYYY-MM-DD')}`).then(res => {
      this.scores = res.data
    })
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
  }

  .insty-table td {
    padding: 10px;
  }

  .insty-ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .insty-ul > li {
    display: inline-block;
    margin-right: 15px;
  }

  .insty-ul > li:last-child {
    margin-right: 0px;
  }
</style>