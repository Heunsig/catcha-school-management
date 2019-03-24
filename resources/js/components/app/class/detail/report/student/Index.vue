<template>
  <div>
    {{ from }} ~ {{ to }}
    <table>
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
          <td>
            <span @click="open_dialog_details(student)">{{ student.full_name }}</span>
          </td>
          <td v-for="group in grade_groups">
            <template v-if="!_.isEmpty(score_data)">
              {{ score_data[student.id][group.id] }}
            </template>
          </td>
        </tr>
      </tbody>
    </table>
    <Dialog_ShowScoreDetails></Dialog_ShowScoreDetails>
  </div>
</template>
<script>
import bus from 'bus'
import Dialog_ShowScoreDetails from './dialogs/Dialog_ShowScoreDetails'
export default {
  components: {
    Dialog_ShowScoreDetails
  },
  data () {
    return {
      score_data: {}
    }
  },
  computed: {
    students () {
      return this.$store.getters['class/students']
    },
    grade_groups () {
      return this.$store.getters['class/grade_groups']
    },
    from () {
      return this.$route.query.from
    },
    to () {
      return this.$route.query.to
    }
  },
  methods: {
    open_dialog_details (student) {
      bus.$emit('dialog:show_score_details', {
        student: student
      })
    }
  },
  created () {
    this.$axios.get(`grade_score/class/${this.$route.params.classinfo_id}/report/group_by/student/from/2019-03-01/to/2019-03-17`).then(res => {
      console.log('res', res)
      this.score_data = res.data
    })
  }
}
</script>