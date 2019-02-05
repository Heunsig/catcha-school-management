import countries from '../json/countries.json'
export default {
  data () {
    return {
      countries: countries
    }
  },
  methods: {
    get_country(code) {
      if (code) {
        return this._.find(this.countries, ['code', code])
      } 

      return {}
    },
    get_country_as_dial_code (dial_code) {
      if (dial_code) {
        return this._.find(this.countries, ['dial_code', dial_code])
      } 

      return {}
    }
  }
}