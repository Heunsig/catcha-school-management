<template>
  <v-card class="ca-dashboard-section">
    <v-card-title>
      <h4 class="ca-typo-title-4">New Students</h4>
      <v-spacer></v-spacer>
      <strong>added within 2 weeks</strong>
    </v-card-title>
    <v-card-text>
      <table class="insty-table">
        <thead>
          <tr>
            <th style="width:50px;"></th>
            <th class="text-xs-center" style="width:120px;">Type</th>
            <th class="text-xs-center" style="width:120px;">Status</th>
            <th class="text-xs-center">Name</th>
            <th class="text-xs-center" style="width:125px;">Created At</th>
            <th class="text-xs-center" style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          <template v-if="!_.isEmpty(new_students)">
            <tr v-for="student in new_students.items">
              <td class="text-xs-center">
                <v-avatar
                  size="35"
                  color="grey lighten-4 ca-cursor-pointer"
                  @click="$router.push({name: 'student.information.basic_information', params: {student_id: student.id}})"
                >
                  <img :src="AVATAR_BASE_URL+'/50/'+student.full_name" :alt="student.full_name"/>
                </v-avatar>
              </td>
              <td class="text-xs-center">{{ student.type.name }}</td>
              <td class="text-xs-center">{{ student.status.name }}</td>
              <td>{{ student.full_name }}</td>
              <td class="text-xs-center">{{ $moment(student.created_at).format('M/D/Y') }}</td>
              <td class="text-xs-center">
                <v-btn 
                  icon
                  @click="$router.push({
                    name: 'student.information.basic_information',
                    params: {
                      student_id: student.id
                    }
                  })"
                >
                  <v-icon color="primary">visibility</v-icon>
                </v-btn>
              </td>
            </tr>
          </template>
          <template v-else>
            <tr>
              <td colspan="4">No Student</td>
            </tr>
          </template>
        </tbody>
      </table>
    </v-card-text>
    <v-card-actions>
      <template v-if="more">
        <v-btn 
          flat 
          block 
          color="orange"
          @click="open_dialog_for_new_students_extension()"
        >
          More
          <span class="ml-1">
          ({{ more }})
          </span>
        </v-btn>
      </template>
      <template v-else>
        <v-btn flat block color="orange" disabled>
          More
        </v-btn>
      </template>
    </v-card-actions>
    <ExtensionDialog></ExtensionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'

import ExtensionDialog from './ExtensionDialog'

export default {
  components: {
    ExtensionDialog
  },
  computed: {
    new_students () {
      return this.$store.getters['dashboard/new_students']
    },
    more () {
      return this.new_students.count ? parseInt(this.new_students.count) : null
    },
    // is_no_more () {
    //   return this.more <= 0
    // }
  },
  methods: {
    open_dialog_for_new_students_extension () {
      // bus.$emit('open_dialog_for_new_students_extension')
      bus.$emit('dialog:new_students')
    }
  }
}
</script>
<style scoped>
  .insty-list-item {
    display: flex;
  }

  .ca-metadata {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .ca-metadata-item {
    display: inline-block;
    margin-right: 3px;
  }

  .ca-metadata-item:last-child {
    margin-right: 0px;
  }

  .ca-metadata-item:after {
    content: ' / ';
  }
  .ca-metadata-item:last-child:after {
    content: none;
  }

  .ca-metadata-item-title {
    color: #3c3c3c;
  }

  .ca-metadata-item-content {
    color: #979797;
  }

  .insty-table {
    width:100%;
    border-collapse: collapse;
  }
  
  .insty-table th {
    font-weight: 300;
    padding: 9px 0;
    border-bottom:1px solid #919191;
    color: #727272;
  }

  .insty-table td {
    padding: 7px 7px;
    border-bottom: 1px solid #e7e7e7;
  }


  .insty-table tbody tr:first-child > td {
    /*border-bottom: none;*/
    padding-top: 10px;
  }

  .insty-table tbody tr:last-child > td {
    border-bottom: none;
  }
</style>