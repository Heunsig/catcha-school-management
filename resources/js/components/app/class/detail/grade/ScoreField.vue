<template>
  <div>
    <el-input :value="score2" @blur="submit($event.target.value)"></el-input>
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
    'score2'
  ],
  // data () {
  //   return {
  //     score: ''
  //   }
  // },
  methods: {
    submit (new_v) {
      console.log('new_v', {
        student_id: this.student_id,
        grade_group_id: this.grade_group_id,
        classinfo_id: this.classinfo_id,
        subject_id: this.subject_id,
        date: this.date,
        score: new_v
      })

      if (new_v && this.score2 != new_v) {
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
  // watch: {
  //   score (new_v) {
  //     console.log('new_v', {
  //       student_id: this.student_id,
  //       grade_group_id: this.grade_group_id,
  //       classinfo_id: this.classinfo_id,
  //       subject_id: this.subject_id,
  //       date: this.date,
  //       score: new_v
  //     })

  //     this.$axios.post(`grade_score`, {
  //       student_id: this.student_id,
  //       grade_group_id: this.grade_group_id,
  //       classinfo_id: this.classinfo_id,
  //       subject_id: this.subject_id,
  //       date: this.date,
  //       score: new_v
  //     }).then(res => {
  //       console.log('res', res)
  //     })
  //   }
  // }
}
</script>