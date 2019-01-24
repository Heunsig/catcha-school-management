<template>
  <div class="insty-pb">
    <div class="insty-pb-header">
      <div class="insty-program-name">{{ program.name }}</div>
      <div class="insty-space"></div>
      <div class="insty-program-date-box">
        <div class="insty-date">
          {{ lastest_term.start_date }} - {{ lastest_term.completion_date }}
        </div>
        <div>
          <v-menu 
            bottom left
          >
            <v-btn
              slot="activator"
              icon
              small
              @click=""
            >
              <v-icon small>query_builder</v-icon>
            </v-btn>
            <v-card>
              <v-card-text>
                <table class="insty-table">
                  <thead>
                    <tr>
                      <th style="width: 175px;">Term</th>
                      <th style="width: 180px;">Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr 
                      v-for="date in program.dates"
                    >
                      <td class="insty-term">{{ date.start_date }} - {{ date.completion_date }}</td>
                      <td class="insty-term">{{ date.reason }}</td>
                    </tr>
                  </tbody>
                </table>
              </v-card-text>
            </v-card>
          </v-menu>
          <v-menu
            bottom left
          >
            <v-btn
              slot="activator"
              icon
              small
              @click=""
            >
              <v-icon small>more_vert</v-icon>
            </v-btn>
            <v-list dense>
              <v-list-tile @click="update_term()">
                <v-list-tile-title>Update term</v-list-tile-title>
              </v-list-tile>
              <v-list-tile @click="del()">
                <v-list-tile-title>Remove</v-list-tile-title>
              </v-list-tile>
            </v-list>
          </v-menu>
        </div>
      </div>
    </div>
    <div>
      <template v-if="!_.isEmpty(available_classes)">
        <ClassItem
          v-for="class_item in available_classes"
          :key="class_item.id"
          :program="program"
          :class_item="class_item"
        ></ClassItem>
      </template>
      <template v-else>
        <div class="text-xs-center">
          <span class="grey--text">No classes</span>
          <v-btn 
            flat
            @click="open_dialog_class_addition()"
          >
            Add Class
          </v-btn>
        </div>
      </template>
    </div>
  </div>
</template>
<script>
import bus from 'bus'
import ClassItem from './ClassItem'

export default {
  components :{
    ClassItem
  },
  props: {
    program: Object
  },
  data: () => ({
    temp_bool: false
  }),
  computed: {
    available_classes () {
      return this.$store.getters['class/available_classes'](this.program)
    },
    lastest_term () {
      return this.program.dates[this.program.dates.length - 1]
    }
  },
  methods: {
    del () {
      this.$store.dispatch('class/delete_program', {
        program_id: this.program.id
      }).then(res => {

      })
    },
    update_term () {
      bus.$emit('open_dialog_program_term_update', {
        program: this.program
      })
    },
    open_dialog_class_addition () {
      bus.$emit('open_dialog_class_addition', {
        program: this.program
      })
    }
  }
}
</script>
<style scoped>
  /*insty - abbreviation of "inner style" */

  .insty-pb {
    padding: 15px;
    margin: 20px 0;
    border: 1px #cecece dashed;
  }

  .insty-pb-header{
    display: flex;
    margin-bottom: 8px;
    align-items: center;
  }

  .insty-space {
    flex: 1 1 auto;
  }

  .insty-program-date-box {
    display: flex;
    align-items: center;
  }

  .insty-table {
    width: 100%;
    border-collapse: collapse;
  }

  .insty-table thead tr th,
  .insty-table tbody tr td {
    padding: 4px 5px;
  }

  .insty-table tbody tr td {
    color: #c4c4c4;
  }

  .insty-table tbody tr:last-child td {
    color: #000;
  }
  
  .insty-table .insty-term {
    text-align: center;
  }

  .insty-table .insty-reason {
    text-align: center;
    font-size: 0.93em;
  }
</style>