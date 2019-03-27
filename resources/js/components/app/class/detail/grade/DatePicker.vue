<template>
  <v-menu
    :close-on-content-click="false"
    v-model="date_picker"
    :nudge-right="40"
    lazy
    transition="scale-transition"
    offset-y
    full-width
    min-width="290px"
  >
    <span slot="activator">{{ date }}</span>
    <v-date-picker 
      v-model="picker2" 
      no-title
      color="green lighten-1" 
      header-color="primary"
      @input="date_picker = false"
    ></v-date-picker>
  </v-menu>
</template>
<script>
export default {
  props: [
    'date'
  ],
  data () {
    return {
      date_picker: false,
      picker2: ''
    }
  },
  watch: {
    picker2 (new_v) {
      // console.log('d', new_v)
      this.$router.push({
        name: 'class.grade', 
        params: {subject_id: this.$route.params.subject_id}, 
        query: {date: new_v}
      })
    }
  },
}
</script>