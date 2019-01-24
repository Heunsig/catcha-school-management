<template>
  <div class="ca-student-class-group">
    <!-- Postponed -->
    <!-- 
      <div>
        <v-btn icon @click="">
          <v-icon>swap_vert</v-icon>
        </v-btn>
      </div> 
    -->
    <div>
      <!-- <class-item
        v-for="item in group"
        :key="item.id"
        :item="item"
        :group="group"
      >
      </class-item> -->
    </div>
  </div>
</template>
<script>
import ClassItem from './ClassItem'

export default {
  components: {
    ClassItem
  },
  props: [
    'group'
  ]
}
</script>