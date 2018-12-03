<template>
  <v-card>
    <v-card-title>
      <div class="ca-title-4">Invoice</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary">Add</v-btn>
    </v-card-title>
    <v-card-text>
      <v-container grid-list-lg fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12>
            <div class="ca-invoice elevation-4">
              <div class="ca-invoice-title">
                <div class="ca-title-4 mr-2">#1</div>
                <v-chip label color="green lighten-1" text-color="white">
                  Paid
                </v-chip>
                <v-spacer></v-spacer>
                <v-btn icon>
                  <v-icon>local_printshop</v-icon>
                </v-btn>
                <v-btn icon>
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-btn icon>
                  <v-icon>remove</v-icon>
                </v-btn>
              </div>
              <div class="ca-invoice-body">
                <div class="ca-invoice-body-header mb-3">
                  <strong class="pr-1">Date Issued</strong>
                  <span>11/26/2018</span>
                  <v-spacer></v-spacer>
                  <div class="ca-tracking-box">
                    <div class="ca-tracking-box-title">Created By</div>
                    <div class="ca-tracking-box-avatar">
                      <v-avatar
                        size="30"
                        color="grey lighten-4"
                      >
                        <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                      </v-avatar>
                    </div>
                  </div>
                  <div class="ca-tracking-box">
                    <div class="ca-tracking-box-title">Updated By</div>
                    <div class="ca-tracking-box-avatar">
                      <v-avatar
                        size="30"
                        color="grey lighten-4"
                      >
                        <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                      </v-avatar>
                    </div>
                  </div>
                  <div class="ca-tracking-box">
                    <div class="ca-tracking-box-title">Deleted By</div>
                    <div class="ca-tracking-box-avatar">
                      <v-avatar
                        size="30"
                        color="grey lighten-4"
                      >
                        <!-- <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar"> -->
                      </v-avatar>
                    </div>
                  </div>
                </div>
                <ul class="ca-invoice-detail">
                  <li class="ca-item">
                    <div class="ca-item-name">ESL Program</div>
                    <v-spacer></v-spacer>
                    <div class="ca-price">$1,242</div>
                  </li>
                </ul>
                <div>
                  <strong>Total</strong>
                  <span>$1,242</span>
                </div>
              </div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>
<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'left',
            sortable: false,
            value: 'name'
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' }
        ],
        desserts: [
          {
            value: false,
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
            expanded: false
          },
          {
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            value: false,
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: '2%'
          },
          {
            value: false,
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: '45%'
          },
          {
            value: false,
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: '22%'
          },
          {
            value: false,
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%'
          }
        ]
      }
    }
  }
</script>