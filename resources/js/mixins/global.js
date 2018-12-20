export default {
  data: () => ({
    RPPI: [ 30, 60, 90, { "text": "All", "value": -1 } ],
    STATUS_ITEMS: [
      'Paid',
      'Waiting',
      'Canceled'
    ]
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
  },
  methods: {
    makeid () {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
    }
  }
}