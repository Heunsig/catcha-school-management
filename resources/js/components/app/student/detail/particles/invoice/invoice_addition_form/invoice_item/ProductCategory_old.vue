<!-- <template>
  <div>
    <v-select

      :items="root_products"
    >
    </v-select>
  </div>
</template>
<script>
export default {
  props: {
    products: Array
  },
  data: ()
  computed: {
    root_products () {
      return this._.filter(this.products, ['parent_product_id', null])
    }
  }
}
</script> -->
<template>
  <div>
    <v-select
      :value="selected_product"
      @input="test($event)"
      label="The first cateogries"
      :items="parent_products"
      item-text="name"
      return-object
    >
    </v-select>
    <template
      v-if="!_.isEmpty(new_parent_products)"
    >
      <product-category
        :parent_products="new_parent_products"
        :products="products"
        :select_product="select_product"
        :select_parent_product="select_parent_product"
      ></product-category>
    </template>
  </div>
</template>
<script>
export default {
  name: 'ProductCategory',
  props: {
    parent_products: Array,
    products: Array,
    select_product: Function,
    select_parent_product: Function
  },
  data: () => ({
    selected_product: null,
    new_parent_products: []
  }),
  watch: {
    // selected_product (parent) {
    //   this.new_parent_products = this._.filter(this.products, ['parent_product_id', parent.id])
    //   if (this._.isEmpty(this.new_parent_products)){
    //     this.select_product(this.selected_product)
    //   } else {
    //     this.select_parent_product()
    //   }
    // }
  },
  methods: {
    test (e) {
      this.selected_product = e
      // this.selected_product = null
    }
  }
}
</script>