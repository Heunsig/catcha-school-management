export default {
  data: () => ({
    RPPI: [ 30, 60, 90, { "text": "All", "value": -1 } ]
  }),
  computed: {
    APP_NAME () {
      return this.$config.APP_NAME
    },
    AXIOS_BASE_URL () {
      return this.$config.AXIOS_BASE_URL
    },
    AVATAR_BASE_URL () {
      return this.$config.AVATAR_BASE_URL
    }
  }
}