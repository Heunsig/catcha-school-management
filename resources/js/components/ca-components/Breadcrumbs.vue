<template>
  <v-breadcrumbs :items="items" class="ca-breadcrumbs">
    <template slot="item" slot-scope="props">
      <span v-if="props.item.disabled" :class="[props.item.disabled && 'ca-disabled']">{{ props.item.text }}</span>
      <a v-else @click="">{{ props.item.text }}</a>
    </template>
  </v-breadcrumbs>
</template>
<script>
export default {
  props: [
    'items'
  ]
}
</script>