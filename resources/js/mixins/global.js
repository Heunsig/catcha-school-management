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
      var possible = "ABCDEFGHIJKLMNOPQRSTUV!@#$%^&*();WXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
    },
    generate_guid() {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      }
      return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    },
    reset_data (init_data) {
      Object.assign(this.$data, this.$options.data.apply(this))
      if (!_.isEmpty(init_data)) {
        Object.assign(this.$data, init_data)
      }
    },
    capitalize_first_letter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  }
}