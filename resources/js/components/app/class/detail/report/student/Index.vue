<template>
  <v-card>
    <v-card-title>
      <h4 class="ca-typo-title-4">Report</h4>
      <v-spacer></v-spacer>
      <div>
        <DatePicker
          :from="from"
          :to="to"
        ></DatePicker>
      </div>
    </v-card-title>
    <v-card-text>
      <table class="insty-table">
        <thead>
          <tr>
            <th>Name</th>
            <th v-for="group in grade_groups" style="width:170px;">
              {{ group.name }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students">
            <td>
              <span @click="open_dialog_details(student)" class="insty-student-name">
                {{ student.full_name }}
              </span>
            </td>
            <td v-for="group in grade_groups" class="text-xs-center">
              <template v-if="!_.isEmpty(score_data)">
                <span v-if="!_.isEmpty(score_data[student.id])">
                  {{ _.isNumber(score_data[student.id][group.id]) ? score_data[student.id][group.id].toFixed(2) : 'Undefined'  }}
                </span>
                <span v-else>
                  Undefined
                </span>
              </template>
            </td>
          </tr>
        </tbody>
      </table>
    </v-card-text>
    <Dialog_ShowScoreDetails
      :from="from"
      :to="to"
    ></Dialog_ShowScoreDetails>
  </v-card>
</template>
<script>
import bus from 'bus'
import Dialog_ShowScoreDetails from './dialogs/Dialog_ShowScoreDetails'
import DatePicker from './DatePicker'
export default {
  components: {
    DatePicker,
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
      return this.$route.query.from || this.$moment().format('Y-MM-DD')
    },
    to () {
      return this.$route.query.to || this.$moment().format('Y-MM-DD')
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
    this.$axios.get(`grade_score/class/${this.$route.params.classinfo_id}/report/group_by/student/from/${this.from}/to/${this.to}`).then(res => {
      console.log('score_data', res)
      this.score_data = res.data
    })
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
    border-collapse: collapse;
  }

  .insty-table td {
    border-bottom: 1px solid #dbdbdb;
  }

  .insty-table tbody tr:last-child td {
    border-bottom: none;
  }


  .insty-table td {
    padding: 7px;
  }

  .insty-student-name {
    cursor: pointer;
  }
  .insty-student-name:hover {
    color: #0dafff;
  }
</style>