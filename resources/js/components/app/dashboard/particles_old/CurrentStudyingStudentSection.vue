<template>
  <v-card>
    <v-card-title>
      
    </v-card-title>
    <v-card-text>
      <div class="text-xs-center mb-4">
        <div>
          <span class="insty-total-title">F1 + Non F1</span>
        </div>
        <div>
          <span class="insty-total">{{ current_studying_students }}</span>
        </div>
      </div>
      <div class="insty-details">
        <div>
          <div class="insty-detail-title">F1</div>
          <div class="insty-detail-content">1000</div>
        </div>
        <div>
          <div class="insty-detail-title">Non F1</div>
          <div class="insty-detail-content">1000</div>
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
    }
  }
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