<template>
  <v-container>
    <v-layout wrap>
      <v-flex xs3>
        Student Type
      </v-flex>
      <v-flex xs9>
        <v-checkbox v-model="selected" label="F1" value="1"></v-checkbox>
        <v-checkbox v-model="selected" label="Vacation English" value="2"></v-checkbox>
        <v-checkbox v-model="selected" label="Regular" value="3"></v-checkbox>
      </v-flex>
    </v-layout>
    <v-layout wrap>
      <v-flex xs12>
        <v-btn color="primary" @click="submit()">
          Submit
        </v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data () {
    return {
      selected: []
    }
  },
  methods: {
    submit () {
      this.$axios.put('setting', {
        selected: this.selected
      }).then(res => {
        console.log('res', res)
      })
    }
  },
  created () {
    this.$axios.get('setting').then(res => {
      console.log('res', res)
      this.selected = res.data
    })
  }
}
</script>