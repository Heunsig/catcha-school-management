<template>
  <v-card>
    <v-card-title>
      <h4 class="ca-typo-title-4">Document List</h4>
    </v-card-title>
    <v-card-text>
      <ul class="insty-document-list">
        <li>
          <div class="list-title">Bus Letter</div>
          <v-spacer></v-spacer>
          <div>
            <v-btn icon @click="open_dialog_bus_letter">
              <v-icon color="grey darken-2">print</v-icon>
            </v-btn>
          </div>
        </li>
      </ul>
    </v-card-text>
    <Dialog_Setting></Dialog_Setting>
  </v-card>
</template>
<script>
import bus from 'bus'

import Dialog_Setting from './bus_letter/Dialog_Setting'

export default {
  components: {
    Dialog_Setting
  },
  methods: {
    open_dialog_bus_letter () {
      bus.$emit('dialog:bus_letter')
    }
  }
}
</script>
<style scoped>
  .insty-document-list {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .insty-document-list > li{
    display: flex;
    align-items: center;
  }

  .insty-document-list .list-title { 
    font-size: 20px;
  }
</style>