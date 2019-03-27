<template>
  <tr>
    <td>
      {{ student.full_name }}
      <v-chip v-if="is_on_leave" small color="grey" text-color="white">Vacation</v-chip>
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
          :is_on_leave="is_on_leave"
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
          :is_on_leave="is_on_leave"
        >
        </ScoreField>
      </template>
    </td>
  </tr>
</template>
<script>
import Attendance from '../Attendance'
import ScoreField from '../ScoreField'
export default {
  props: [
    'scores',
    'student',
    'date'
  ],
  components: {
    Attendance,
    ScoreField
  },
  computed: {
    grade_groups () {
      return this.$store.getters['class/grade_groups']
    },
    is_on_leave (leaves) {
      console.log('hi')
      let today = this.$moment()

      for (let i = 0 ; i < this.student.leaves.length ; i++) {
        if ( today.isAfter(this.$moment(this.student.leaves[i].start_date), 'date') &&
            today.isBefore(this.$moment(this.student.leaves[i].completion_date), 'date')) 
        {
          return true
        }
      }
    }
  },
  methods: {
    get_score (student_id, grade_group_id) {
      let a = this._.find(this.scores[student_id], {'grade_group_id': grade_group_id}) || {}
      console.log(typeof a.score, a.score)
      if (typeof a.score !== 'undefined' && a.score !== null) {
        return a.score.toString()
      } else {
          return ''  
      }
    }
  }
}
</script>