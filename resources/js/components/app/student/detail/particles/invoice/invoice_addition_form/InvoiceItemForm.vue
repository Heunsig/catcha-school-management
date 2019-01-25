<template>
  <v-card>
    <v-card-title class="py-1 grey lighten-2">
      <div class="ca-typo-title-5"># {{ index }}</div>
      <v-spacer></v-spacer>
      <v-btn icon @click="remove()" :disabled="GUID === 'first'">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <el-form ref="form" :model="form" :rules="rules" label-position="top">
        <v-container fluid class="pa-0 ca-grid-list-1">
          <v-layout wrap>
            <v-flex xs12>
              <el-form-item label="Product" class="ca-label" prop="product_id">
                <el-cascader
                  v-model="form.product_id"
                  :options="products"
                  placeholder="Please select product"
                  clearable
                  class="ca-block"
                >
                </el-cascader>
              </el-form-item>
            </v-flex>
            <template>
              <v-flex xs12>
                <el-form-item label="Week" class="ca-label" prop="week">
                  <el-input 
                    v-model="form.week"
                    placeholder="Please input week" 
                  ></el-input>
                </el-form-item>
              </v-flex>
              <!-- <v-flex xs6>
                <el-form-item label="Start Date" class="ca-label" prop="start_date">
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
                  </v-menu>
                </el-form-item>
              </v-flex> -->
              <v-flex xs9>
                <el-form-item label="Price" class="ca-label">
                  <el-input 
                    v-model="form.price"
                    placeholder="Please input price" 
                  ></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs3>
                <el-form-item label="Quantity" class="ca-label">
                  <el-input-number 
                    v-model="form.quantity"
                    class="ca-block"
                  ></el-input-number>
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
              </v-flex>
            </template>
          </v-layout>
        </v-container>
      </el-form>
    </v-card-text>
  </v-card>
</template>
<script>

export default {
  props: {
    GUID: String,
    index: Number,
    // products: Array
  },
  data: () => ({
    form: {
      product_id: null,
      // start_date: null,
      // completion_date: null,
      week: null,
      price: null,
      quantity: 1,
      note: null
    },
    // start_date_picker: false,
    // completion_date_picker: false,
    rules: {
      product_id: [
        { required: true, message: 'Please select product', trigger: 'change' }
      ]
    }
  }),
  computed: {
    products () {
      return this.$store.getters['product/products']
    }
  },
  methods: {
    validate () {
      let $this = this
      let result
      this.$refs['form'].validate((valid) => {
        if (valid) {
          result = $this.form
        } else {
          result = false
        }
      })

      return result
    },
    format_date (date) {
      return date ? this.$moment(date).format('MM/DD/YYYY') : ''
    },
    remove () {
      this.$emit('remove')
    },
    reset () {
      this.$refs['form'].resetFields()
    }
  }
}
</script>