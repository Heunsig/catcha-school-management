<template>
  <div class="insty-pb">
    <div class="insty-pb-header">
      <div class="insty-program-name">
        {{ program.name }} 
        <v-chip 
          label 
          :color="status_color"
          text-color="white"
          small
        >
          {{ program.status }}
        </v-chip>
      </div>
      <div class="insty-space"></div>
      <div class="insty-program-date-box">
        <div class="insty-date">
          <!-- {{ $moment(lastest_term.start_date).format('M/D/Y') }} - {{ $moment(lastest_term.completion_date).format('M/D/Y') }} -->
          <template v-if="exist_date">
            {{ $moment(start_date).format('M/D/Y') }} - {{ $moment(completion_date).format('MM/DD/Y') }}
          </template>
        </div>
        <div>
          <v-btn v-if="exist_date" icon @click="open_dialog_program_term_history()">
            <v-icon small>query_builder</v-icon>
          </v-btn>
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
              <v-list-tile v-if="exist_date" @click="update_term()">
                <v-list-tile-title>Update term</v-list-tile-title>
              </v-list-tile>
              <v-list-tile @click="open_dialog_program_reset()">
                <v-list-tile-title>Reset</v-list-tile-title>
              </v-list-tile>
              <!-- <v-list-tile @click="del()">
                <v-list-tile-title>Remove</v-list-tile-title>
              </v-list-tile> -->
            </v-list>
          </v-menu>
        </div>
      </div>
    </div>
    <div>
      <template v-if="exist_date">
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
              small
              color="blue"
              @click="open_dialog_class_addition()"
            >
              Add Class
            </v-btn>
          </div>
        </template>
      </template>
      <template v-else>
        Please set the program term.
        <v-btn
          flat
          small
          color="primary"
          @click="set_init_program_term()"
        >
          Set Program Term
        </v-btn>
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
  computed: {
    available_classes () {
      return this.$store.getters['class/available_classes'](this.program)
    },
    exist_date () {
      return !this._.isEmpty(this.program.dates)
    },
    start_date () {
      return this.exist_date ? this.program.dates[0].start_date:null
    },
    completion_date () {
      return this.exist_date ? this.program.dates[this.program.dates.length - 1].completion_date:null
    },
    is_canceled () {
      if (this.program.status === 'Canceled') {
        return true
      } 

      return false
    },
    status_color () {
      if (this.program.status === 'Paid') {
        return 'green lighten-1'
      } else if (this.program.status === 'Waiting') {
        return 'amber darken-1'
      } else if (this.program.status === 'Canceled') {
        return 'grey darken-1'
      }
    },
    // lastest_term () {
    //   return this.program.dates[this.program.dates.length - 1]
    // }
  },
  methods: {
    open_dialog_program_reset () {
      bus.$emit('dialog:program_reset', {
        program: this.program
      })
    },
    del () {
      this.$store.dispatch('class/delete_program', {
        program_id: this.program.id
      }).then(res => {

      })
    },
    set_init_program_term () {
      bus.$emit('dialog:init_program_term', {
        program: this.program
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
    },
    open_dialog_program_term_history () {
      bus.$emit('dialog:program_term_history', {
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