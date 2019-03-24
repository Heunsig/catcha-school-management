<template>
  <v-card style="overflow:auto;">
    <v-card-title>
      <h4 class="ca-typo-title-4">{{ grade_group_name }}</h4>
    </v-card-title>
    <v-card-text style="height:300px; overflow:auto;">
      <table style="width:100%;">
        <thead>
          <tr>
            <th></th>
            <th>Average</th>
            <th v-for="subject in subjects" style="padding:5px;">
              {{ subject.name }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <strong>Average</strong>
            </td>
            <td></td>
            <td v-for="subject in subjects">
              <span v-if="!_.isEmpty(scores)">
                {{ avg(subject.id) }}
              </span>
            </td>
          </tr>
          <tr v-for="date in between">
            <td>{{ date }}</td>
            <td>
              <span v-if="!_.isEmpty(scores)">
                {{ avg_2(date) }}
              </span>
            </td>
            <td v-for="subject in subjects">
              <span v-if="!_.isEmpty(scores)">
                {{ test2(date, subject.id) }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </v-card-text>
  </v-card>  
</template>
<script>
export default {
  props: [
    'scores',
    'grade_group_id',
    'grade_group_name'
  ],
  computed: {
    from () {
      return this.$route.query.from
    },  
    to () {
      return this.$route.query.to
    },
    between () {
      let result = []
      let diff = this.$moment(this.to).diff(this.$moment(this.from), 'days')

      for (let i = 0 ; i < diff ; i++) {
        result.push(this.$moment(this.from).add(i, 'days').format('MM/DD/Y'))
      }

      return result
    },
    subjects () {
      return this.$store.getters['class/subjects']
    },
  },
  methods: {
    test2 (date, subject_id) {
      let a = {}

      if (!this._.isEmpty(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')])) {

        if (!this._.isEmpty(this._.find(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')], {'subject_id':subject_id}))) {
          a = this._.find(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')], {'subject_id':subject_id})
          return a['score']
        }
      }

      return 'E'
    },
    avg (subject_id) {
      let result = 0
      let j = 0

      for (let i = 0 ; i < this.between.length ; i++) {
        if (this.test2(this.between[i], subject_id) !== 'E') {
          j++
          result += this.test2(this.between[i], subject_id)
        }
      }

      // console.log('kkkkk', result / j)
      return result / j
    },
    avg_2 (date) {
      let result = 0 
      let j = 0

      for (let i = 0 ; i < this.subjects.length ; i++) {
        if (this.test2(date, this.subjects[i].id) !== 'E') {
          console.log('hihi')
          j++
          result += this.test2(date, this.subjects[i].id)
        } 
      }

      return result / j
    }
  }
}
</script>