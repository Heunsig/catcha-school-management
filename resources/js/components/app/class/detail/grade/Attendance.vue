<template>
  <div>
    <v-radio-group :value="score2" @change="submit($event)" :disabled="is_on_leave">
      <v-radio label="Present" value="100"></v-radio>
      <v-radio label="Tardy" value="95"></v-radio>
      <v-radio label="Absent" value="0"></v-radio>
      <v-radio label="Execuse" value=""></v-radio>
    </v-radio-group>
  </div>
</template>
<script>
export default {
  props: [
    'student_id',
    'grade_group_id',
    'classinfo_id',
    'subject_id',
    'date',
    'score2',
    'is_on_leave'
  ],
  data () {
    return {
      score: ''
    }
  },
  methods: {
    submit (new_v) {

      this.$axios.post(`grade_score`, {
        student_id: this.student_id,
        grade_group_id: this.grade_group_id,
        classinfo_id: this.classinfo_id,
        subject_id: this.subject_id,
        date: this.date,
        score: new_v
      }).then(res => {
        console.log('res', res)
      })
    }
  }
}
</script>