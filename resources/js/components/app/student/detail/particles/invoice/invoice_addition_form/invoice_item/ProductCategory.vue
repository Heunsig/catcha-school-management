<template>
  <div>
    <v-text-field
      :value="category"
      @input="select($event)"
    >
    </v-text-field>
    <!-- <v-select
      v-for="(item, i) in test"
      :key="'category_'+i"
      :items="parent_products"
      item-text="name"
      item-value="id"
      @input="select($event, item)"
    >
    </v-select> -->
  </div>
</template>
<script>
export default {
  props: [
    'products',
    'category'
  ],
  computed: {
    parent_products () {
      return this._.filter(this.products, ['parent_product_id', null])
    }
  },
  methods: {
    has_children (id) {
      if (!this._.isEmpty(this._.filter(this.products, ['parent_product_id', id]))) {
        return true
      } else {
        return false
      }
    },
    select ($event) {
      this.$emit('ggg', $event)
    }
  },
  destroyed () {
    console.log('adfa')
  }
}
</script>