<template>
  <v-card style="overflow:auto;">
    <v-card-title>
      <h4 class="ca-typo-title-4">{{ grade_group_name }}</h4>
      <v-spacer></v-spacer>
      <div>
        <span>{{ $moment(from).format('MM/DD/Y') }} ~ {{ $moment(to).format('MM/DD/Y') }}</span>
      </div>
    </v-card-title>
    <v-card-text style="height:400px; overflow:auto;">
      <div>
        <strong>Total Average</strong>:
        <span v-if="!_.isEmpty(scores)">
          {{ cut_decimal(total_avg) }}
        </span>
      </div>
      <table class="insty-table">
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
          <!-- <tr>
            <td class="text-xs-right">
              <strong>Average</strong>
            </td>
            <td>
              <span v-if="!_.isEmpty(scores)">
                {{ total_avg }}
              </span>
            </td>
            <td v-for="subject in subjects" class="text-xs-center">
              <strong v-if="!_.isEmpty(scores)">
                {{ avg(subject.id) }}
              </strong>
            </td>
          </tr> -->
          <tr v-for="date in between">
            <td class="text-xs-right">
              {{ format_date(date) }}
            </td>
            <td class="text-xs-center">
              <strong v-if="!_.isEmpty(scores)">
                {{ cut_decimal(avg_2(date)) }}
              </strong>
            </td>
            <td v-for="subject in subjects" class="text-xs-center">
              <span v-if="!_.isEmpty(scores)">
                {{ get_score(date, subject.id) }}
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
    'grade_group_name',
    'from',
    'to'
  ],
  computed: {
    total_avg () {
      // let avg = 0

      // let sum_1 = 0
      let sum_2 = 0

      // this.subjects.forEach(subject => {
      //   let a = this.avg(subject.id)
      //   if (this._.isNumber(a)) {
      //     sum_1 += a
      //   }
      // })

      let j = 0
      this.between.forEach(date => {
        let a = this.avg_2(date)
        console.log('a', a)
        if (this._.isNumber(a)) {
          console.log('hi')
          j++
          sum_2 += a
        }
      })

      console.log('sum', sum_2)

      return sum_2/j ? sum_2/j : 'Undefined'

      // console.log('total', sum_1+','+sum_2)
      // return (sum_1 + sum_2) / 2

    },
    between () {
      let result = []
      let diff = this.$moment(this.to).diff(this.$moment(this.from), 'days')

      result.push(this.$moment(this.from))
      for (let i = 1 ; i < diff + 1 ; i++) {
        result.push(this.$moment(this.from).add(i, 'days'))
      }

      return result
    },
    subjects () {
      return this.$store.getters['class/subjects']
    },
  },
  methods: {
    cut_decimal (value) {
      if (this._.isNumber(value)) {
        return value.toFixed(2)
      } else {
        return value
      }
    },
    format_date (date) {
      return this.$moment(date).format('MM/DD/Y')
    },
    get_score (date, subject_id) {
      let grade_group_id = this.grade_group_id
      let scores = this.scores
      let formatted_date = this.$moment(date).format('Y-MM-DD')

      let a = {}
      if (scores[grade_group_id][formatted_date]) {
        if (a = this._.find(scores[grade_group_id][formatted_date], {'subject_id': subject_id})) {
          return a.score ? a.score : 'Excused'
        }
      }

      return 'Excused'
      // this._.isEmpty
      // if (this._.isEmpty(scores[grade_group_id][]))
      // let a = {}

      // if (!this._.isEmpty(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')])) {

      //   if (!this._.isEmpty(this._.find(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')], {'subject_id':subject_id}))) {
      //     a = this._.find(this.scores[this.grade_group_id][this.$moment(date, 'MM/DD/Y').format('Y-MM-DD')], {'subject_id':subject_id})
      //     console.log('a', a)
      //     return a.score
      //   }
      // }

      // return 'Excused'
    },
    avg (subject_id) {
      let result = 0
      let j = 0

      for (let i = 0 ; i < this.between.length ; i++) {
        let a = this.get_score(this.between[i], subject_id)
        if (this._.isNumber(a)) {
          j++
          result += a
        }
      }

      return result / j ? result/j : 'Undefined'
    },
    avg_2 (date) {
      let result = 0 
      let j = 0

      for (let i = 0 ; i < this.subjects.length ; i++) {
        let a = this.get_score(date, this.subjects[i].id)
        if (this._.isNumber(a)) {
          j++
          result += a
        } 
      }

      return result / j ? (result / j) : 'Undefined'
      // return result
    }
  }
}
</script>
<style scoped>
  .insty-table {
    width: 100%;
    border-collapse: collapse;
  }
  .insty-table thead th, .insty-table tbody td {
    padding: 7px;
  }
  .insty-table tbody td {
    border: 1px solid #747474;
  }

  .excused {
    background :#acacac;
  }
</style>