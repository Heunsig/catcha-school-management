<template>
  <div 
    class="insty-floating-box"
    v-bind:style="[styleObject]"
  >
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: [
    'top',
    'bottom',
    'right',
    'left',
    'zIndex'
  ],
  data () {
    return {
      styleObject: {}
    }
  },
  methods: {
    convert_value (location) {
      let value = parseInt(location)
      if (isNaN(value)) {
        return 0 + 'px'
      } else {
        return value + 'px'
      }
    },
    convert_zIndex (zIndex) {
      let value = parseInt(zIndex)
      if (isNaN(value)) {
        return 0
      } else {
        return value
      }
    },
    generate_style () {
      if (typeof this.top !== 'undefined') {
        this.styleObject.top = this.convert_value(this.top)
      }
      if (typeof this.bottom !== 'undefined') {
        this.styleObject.bottom = this.convert_value(this.bottom)
      }
      if (typeof this.right !== 'undefined') {
        this.styleObject.right = this.convert_value(this.right)
      }
      if (typeof this.left !== 'undefined') {
        this.styleObject.left = this.convert_value(this.left)
      }

      if (typeof this.zIndex !== 'undefined') {
        this.styleObject.zIndex = this.convert_zIndex(this.zIndex)
      } else {
        this.styleObject.zIndex = 1
      }
    }
  },
  created () {
    this.generate_style()
  }
}
</script>
<style scoped>
  .insty-floating-box {
    position: fixed;
  }
</style>