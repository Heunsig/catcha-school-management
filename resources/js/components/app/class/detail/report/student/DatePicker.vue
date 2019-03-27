<template>
  <div>
    <span>{{ $moment(from).format('MM/DD/Y') }} ~ {{ $moment(to).format('MM/DD/Y') }}</span>
    <v-menu
      v-model="menu"
      :close-on-content-click="false"
    >
      <v-btn small icon slot="activator">
        <v-icon small>calendar_today</v-icon>
      </v-btn>  
      <v-card>
        <v-card-text>
          <v-container fluid class="pa-0 ca-grid-list-3-x">
            <v-layout wrap>
              <v-flex xs6>
                <v-date-picker 
                  v-model="test_1" 
                  color="green lighten-1" 
                  header-color="primary"
                  no-title
                  :max="test_2"
                ></v-date-picker>
              </v-flex>
              <v-flex xs6>
                <v-date-picker 
                  v-model="test_2" 
                  color="green lighten-1" 
                  header-color="primary"
                  no-title
                  :min="test_1"
                ></v-date-picker>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <div class="mr-2">{{ $moment(test_1).format('MM/DD/Y') }} ~ {{ $moment(test_2).format('MM/DD/Y') }}</div>
          <v-btn flat color="grey darken-3" @click="menu = false">Close</v-btn>
          <v-btn flat color="primary" @click="confirm()">Confirm</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>
    
  </div>
</template>
<script>
export default {
  props: [
    'from',
    'to'
  ],
  data () {
    return {
      menu: false,
      test_1: '',
      test_2: '',
      date_picker_1: false,
      date_picker_2: false,
    }
  },
  watch: {
    menu (new_v) {
      if (new_v) {
        this.test_1 = this.from
        this.test_2 = this.to
      }
    }
  },
  methods: {
    confirm () {
      this.menu = false
      this.$router.push({
        name: 'class.report',
        query: {
          from: this.test_1,
          to: this.test_2
        }
      })
    }
  }
}
</script>