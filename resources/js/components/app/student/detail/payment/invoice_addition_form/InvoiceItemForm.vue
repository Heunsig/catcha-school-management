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
            <v-flex xs12 
              v-for="(attribute, i) in attributes" 
              :key="attribute.id+'_'+i"
            >
              <el-form-item 
                :label="'Attribute '+ (i+1)" 
                class="ca-label" 
                :prop="'attributes.'+i+'.attribute_value_id'"
                :rules="{required: true, message: 'Attribute '+ (i+1) + ' is required', trigger: 'change'}"
              >
                <el-select 
                  v-model="form['attributes'][i]['attribute_value_id']"
                  clearable 
                  placeholder="Please select"
                  class="ca-block"
                >
                  <el-option
                    v-for="option in attribute.values"
                    :key="option.id"
                    :label="option.value"
                    :value="parseInt(option.id)"
                  >
                  </el-option>
                </el-select>
              </el-form-item>
            </v-flex>
            <template v-if="!_.isEmpty(form.product_id)">
              <v-flex xs12 v-if="is_program">
                <el-form-item label="Week" class="ca-label" prop="week">
                  <el-input 
                    v-model="form.week"
                    placeholder="Please input week" 
                  ></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs9>
                <el-form-item label="Price" class="ca-label">
                  <el-input 
                    v-model="form.price"
                    placeholder="Please input price" 
                  ></el-input>
                </el-form-item>
              </v-flex>
              <v-flex xs3 v-if="is_textbook">
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
  },
  data: () => ({
    form: {
      product_id: null,
      week: null,
      price: null,
      quantity: 1,
      note: null,
      attributes: []
    },
    attributes: [],
    rules: {
      product_id: [
        { required: true, message: 'Please select product', trigger: 'change' }
      ],
      // 'attributes.attribute_value_id': [
      //   { required: true, message: 'Please select product', trigger: 'change' }
      // ]
    },
    // result: []
  }),
  computed: {
    products () {
      return this.$store.getters['product/products']
    },
    product_id () {
      return this.form.product_id
    },
    is_program () {
      if (this.form.product_id[0] === 1) {
        return true
      }
      return false
    },
    is_textbook () {
      if (this.form.product_id[0] === 2) {
        return true
      }

      return false
    }
  },
  watch: {
    product_id (new_value) {
      let result = []
      this.track_selected_products(result, this.products, new_value, new_value.length - 1)
      this.attributes = this.extract_attributes(result)
      this.form.attributes = []
      for (let i = 0 ; i < this.attributes.length ; i++) {
        this.form.attributes.push({
          attribute_id: this.attributes[i].id,
          attribute_value_id: null
        })
      }
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

      // console.log('result', result)
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
    },
    track_selected_products (result, products, values=null, last_index=0, index=0 ) {
      for (let i = 0 ; i < products.length ; i++) {
        if(products[i].value === values[index]) {
          if (last_index == index) {
            result.push(products[i])
          } else {
            result.push(products[i])
            this.track_selected_products(result, products[i].children, values, last_index, index += 1)  
          }
        }
      }
    },
    extract_attributes (products) {
      let result = []
      for (let i = 0 ; i < products.length ; i++) {
        if (!this._.isEmpty(products[i].attributes)) {
          result = result.concat(products[i].attributes)
        }
      }

      return result
    }
  }
}
</script>