<template>
  <v-card>
    <v-card-title class="py-1">
      <div class="ca-typo-title-5">#</div>
      <v-spacer></v-spacer>
      <v-btn icon @click="remove()">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <el-form ref="form" :model="form" label-position="top">
        <v-container fluid class="pa-0 ca-grid-list-1">
          <v-layout wrap>
            <v-flex xs12>
              <el-form-item label="Product" class="ca-label">
                <el-cascader
                  v-model="form.product_id"
                  :options="products"
                  placeholder="Please select product"
                  class="ca-block"
                >
                </el-cascader>
              </el-form-item>
              <!-- <treeselect
                :value="product"
                @input="$emit('update:product', $event)"
                :options="products"
                :disable-branch-nodes="true"
                :show-count="true"
                placeholder="Where are you from?"
              >
              </treeselect> -->
            </v-flex>
            <template>
              <v-flex xs6>
                <el-form-item label="Start Date" class="ca-label">
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
                    <el-input 
                      slot="activator"
                      :value="format_date(form.start_date)"
                      placeholder="Please input" 
                      readonly
                    ></el-input>
                    <!-- <v-text-field
                      slot="activator"
                      :value="format_date(form.start_date)"
                      label="Start Date"
                      prepend-icon="event"
                      readonly
                    ></v-text-field> -->
                    <v-date-picker v-model="form.start_date" @input="start_date_picker = false"></v-date-picker>
                  </v-menu>
                </el-form-item>
              </v-flex>
              <v-flex xs6>
                <el-form-item label="Completion Date" class="ca-label">
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
                    <el-input 
                      slot="activator"
                      :value="format_date(form.completion_date)"
                      placeholder="Please input" 
                      readonly
                    ></el-input>
                    <v-date-picker
                      v-model="form.completion_date"
                      @input="completion_date_picker = false"
                    ></v-date-picker>
                    <!-- <v-text-field
                      slot="activator"
                      :value="format_date(completion_date)"
                      label="Completion Date"
                      prepend-icon="event"
                      readonly
                    ></v-text-field> -->
                    <!-- <v-date-picker
                      :value="completion_date"
                      @input="update_completion_date($event)"
                    ></v-date-picker> -->
                  </v-menu>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Price" class="ca-label">
                <!-- <v-text-field
                  :value="price"
                  @input="$emit('update:price', $event)"
                  label="Price"
                >
                </v-text-field> -->
                  <el-input 
                    v-model="form.price"
                    placeholder="Please input price" 
                    readonly
                  ></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <!-- <el-form ref="form1" :model="form" label-width="120px">
                  <el-form-item label="Activity name">
                    <el-input v-model="test"></el-input>
                  </el-form-item>
                </el-form> -->
                <!-- <v-text-field
                  :value="quantity"
                  @input="$emit('update:quantity', $event)"
                  label="Quantity"
                >
                </v-text-field> -->
                <el-form-item label="Quantity" class="ca-label">
                  <el-input-number 
                    v-model="form.quantity"
                    class="ca-block"
                  ></el-input-number>
                  <!-- <el-input 
                    v-model="form.quantity"
                    placeholder="Please input quantity" 
                    readonly
                  ></el-input> -->
                </el-form-item>
              </v-flex>
              <v-flex xs12>
                <el-form-item label="Note" class="ca-label">
                  <el-input
                    type="textarea"
                    :autosize="{ minRows: 6 }"
                    placeholder="Please input note"
                    v-model="form.note">
                  </el-input>
                </el-form-item>
                <!-- <v-textarea
                  :value="note"
                  @input="$emit('update:note', $event)"
                  label="Note"
                >
                </v-textarea> -->
              </v-flex>
            </template>
          </v-layout>
        </v-container>
      </el-form>
    </v-card-text>
  </v-card>
</template>
<script>

// import Treeselect from '@riophae/vue-treeselect'
// import '@riophae/vue-treeselect/dist/vue-treeselect.css'
export default {
  // components: {
  //   Treeselect
  // },
  // props: [
  //   'index',
  //   'products',
  //   'product',
  //   'start_date',
  //   'completion_date',
  //   'price',
  //   'quantity',
  //   'note',
  // ],
  props: {
    products: Array
  },
  data: () => ({
    form: {
      product_id: null,
      start_date: null,
      completion_date: null,
      price: null,
      quantity: null,
      note: null
    },
    // test: '',
    start_date_picker: false,
    completion_date_picker: false,
    // options: [
    //   {
    //     id: 1,
    //     label: 'a',
    //     children: [
    //       {
    //         id: 'aa',
    //         label: 'asdfasdf',
    //       }, 
    //       {
    //         id: 'ab',
    //         label: '123123',
    //         children: [
    //           {
    //             id: 'cccc',
    //             label: '123123'
    //           }
    //         ]
    //       } 
    //     ],
    //   }, 
    //   {
    //     id: 'b',
    //     label: '123123',
    //   }, 
    //   {
    //     id: 'c',
    //     label: '123123',
    //   } 
    // ],
  }),
  methods: {
    // update_start_date (val) {
    //   this.$emit('update:start_date', val)
    //   this.start_date_picker = false
    // },
    // update_completion_date (val) {
    //   this.$emit('update:completion_date', val)
    //   this.completion_date_picker = false
    // },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    remove () {
      this.$emit('remove')
    },
    // handleChange (value) {
    //   console.log('va', value)
    // }
  }
}
</script>