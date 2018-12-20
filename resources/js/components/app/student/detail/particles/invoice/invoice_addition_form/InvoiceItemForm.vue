<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-5">#</div>
      <v-spacer></v-spacer>
      <v-btn icon @click="remove()">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0">
        <v-layout wrap>
          <v-flex xs12>
            <treeselect
              :value="product"
              @input="$emit('update:product', $event)"
              :options="products"
              :disable-branch-nodes="true"
              :show-count="true"
              placeholder="Where are you from?"
            >
            </treeselect>
          </v-flex>
          <template>
            <v-flex xs6>
              <v-menu
                :close-on-content-click="false"
                v-model="start_date_picker"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  :value="format_date(start_date)"
                  label="Start Date"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker 
                  :value="start_date"
                  @input="update_start_date($event)"></v-date-picker>
              </v-menu>
            </v-flex>
            <v-flex xs6>
              <v-menu
                :close-on-content-click="false"
                v-model="completion_date_picker"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  :value="format_date(completion_date)"
                  label="Completion Date"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker
                  :value="completion_date"
                  @input="update_completion_date($event)"
                ></v-date-picker>
              </v-menu>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                :value="price"
                @input="$emit('update:price', $event)"
                label="Price"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                :value="quantity"
                @input="$emit('update:quantity', $event)"
                label="Quantity"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-textarea
                :value="note"
                @input="$emit('update:note', $event)"
                label="Note"
              >
              </v-textarea>
            </v-flex>
          </template>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>
<script>

import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
export default {
  components: {
    Treeselect
  },
  props: [
    'products',
    'product',
    'start_date',
    'completion_date',
    'price',
    'quantity',
    'note',
    // 'options'
  ],
  data: () => ({
    start_date_picker: false,
    completion_date_picker: false,
    // category: [{
    //   id: 0
    // }],
    options: [
      {
        id: 1,
        label: 'a',
        children: [
          {
            id: 'aa',
            label: 'asdfasdf',
          }, 
          {
            id: 'ab',
            label: '123123',
            children: [
              {
                id: 'cccc',
                label: '123123'
              }
            ]
          } 
        ],
      }, 
      {
        id: 'b',
        label: '123123',
      }, 
      {
        id: 'c',
        label: '123123',
      } 
    ],
  }),
  methods: {
    update_start_date (val) {
      this.$emit('update:start_date', val)
      this.start_date_picker = false
    },
    update_completion_date (val) {
      this.$emit('update:completion_date', val)
      this.completion_date_picker = false
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    remove () {
      this.$emit('remove')
    }
  }
}
</script>