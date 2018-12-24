<template>
  <div>
    <!-- <div class="ca-typo-title-5">Payment Status</div> -->
    <v-container grid-list-xs fluid class="pa-0">
      <v-layout wrap>
        <v-flex xs12>
          <el-select 
            :value="status"
            @input="$emit('update:status', $event)"
            clearable 
            placeholder="Select"
          >
            <el-option
              v-for="item in STATUS_ITEMS"
              :key="item"
              :label="item"
              :value="item">
            </el-option>
          </el-select>
          <!-- <v-select
            :value="status"
            @input="$emit('update:status', $event)"
            :items="STATUS_ITEMS"
            label="Payment Status"
          >
          </v-select>           -->
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>
<script>

export default {
  props: [
    'status'
  ]
}
</script>