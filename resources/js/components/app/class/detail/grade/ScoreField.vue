<template>
  <div>
    <el-input 
      v-model="test"
      @blur="submit($event.target.value)"
      :disabled="is_on_leave"
    ></el-input>
    <v-checkbox
      :input-value="is_excused"
      readonly
      hide-details
      class="pt-0 mt-1"
      label="Excused"
    ></v-checkbox>
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
      test: ''
    }
  },
  computed: {
    is_excused () {
      if (this.test) {
        return false
      } else {
        return true
      }
    }
  },
  watch: {
    score2 (new_v) {
      console.log('n222', new_v)
      this.test = new_v
    }
  },
  methods: {
    submit (new_v) {
      if (this.score2 != new_v) {
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
}
</script>