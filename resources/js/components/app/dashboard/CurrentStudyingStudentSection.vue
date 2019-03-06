<template>
  <v-card>
    <v-card-title>
      <h4 class="ca-typo-title-4">
        Total Students in school
      </h4>
    </v-card-title>
    <v-card-text style="height: 433px;">
      <div class="text-xs-center mb-4">
        <div>
          <span class="insty-total">{{ total_student }}</span>
        </div>
      </div>
      <div class="insty-details">
        <div v-for="(group, key) in grouped_students">
          <div class="insty-detail-title">{{ key }}</div>
          <div class="insty-detail-content">{{ group.length }}</div>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  computed: {
    current_studying_students () {
      return this.$store.getters['dashboard/current_studying_students']
    },
    total_student () {
      return this.current_studying_students.length
    },
    grouped_students () {
      return this._.groupBy(this.current_studying_students, 'type.name')
    }
  },
}
</script>
<style scoped>
  .insty-total-title {
    font-weight: bold;
    font-size: 18px;
  }
  .insty-total {
    font-size: 60px;
  }
  .insty-details {
    display: flex;
  }

  .insty-details > div {
    flex: 1 1 auto;
    text-align: center;
  }

  .insty-detail-title {
    font-weight: bold;
    font-size: 16px;
  }

  .insty-detail-content {
    font-size: 40px;
  }
</style>