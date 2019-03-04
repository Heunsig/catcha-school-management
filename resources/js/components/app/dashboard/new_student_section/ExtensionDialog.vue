<template>
  <v-dialog v-model="is_active" scrollable persistent max-width="1000">
    <v-card>
      <v-card-title>
        <h4 class="ca-typo-title-4">New Students</h4>
        <v-spacer></v-spacer>
        <div>
          <el-input
            v-model="search"
            placeholder="Search"
            suffix-icon="el-icon-search"
          ></el-input>
        </div>
        <!-- <v-btn
          icon
        >
          <v-icon>more_vert</v-icon>
        </v-btn> -->
        <!-- <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field> -->
      </v-card-title>
      <v-card-text>
        <v-data-table
          :headers="headers"
          :items="full_new_students"
          :search="search"
          :pagination.sync="pagination"
          :rows-per-page-items="RPPI"
        >
          <template slot="items" slot-scope="props">
            <td>
              <v-btn 
                fab 
                icon
                @click="open_big_img(AVATAR_BASE_URL+'/400/'+props.item.full_name)"
              >
                <v-avatar
                  size="45"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL+'/50/'+props.item.full_name" :alt="props.item.full_name"/>
                </v-avatar>
              </v-btn>
            </td>
            <td>{{ props.item.type.name }}</td>
            <td>{{ props.item.status.name }}</td>
            <td>{{ props.item.full_name }}</td>
            <td>{{ $moment(props.item.created_at).format('MM/DD/YYYY') }}</td>
            <td>
              <v-btn 
                icon
                @click="$router.push({
                  name: 'student.information.basic_information',
                  params: {
                    student_id: props.item.id
                  }
                })"
              >
                <v-icon color="primary">visibility</v-icon>
              </v-btn>
            </td>
          </template>
          <v-alert slot="no-results" :value="true" color="error" icon="warning">
            Your search for "{{ search }}" found no results.
          </v-alert>
        </v-data-table>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <!-- <v-btn color="green darken-1" flat @click="is_active = false">Close</v-btn> -->
        <v-btn color="grey darken-2" flat @click="is_active = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
import bus from 'bus'

export default {
  data () {
    return {
      loading: false,
      is_active: false,
      search: '',
      pagination: {
        descending: true,
        sortBy: 'created_at'
      },
      headers: [
        {
        text: '',
        sortable: false,
      },
      {
        text: 'Type',
        value: 'type'
      },
      {
        text: 'Status',
        value: 'status.name'
      },
      {
        text: 'Name',
        value: 'full_name'
      },
      {
        text: 'Created At',
        value: 'created_at'
      },
      {
        text: 'Actions',
        sortable: false
      }
      ],
    }
  },
  computed: {
    full_new_students () {
      return this.$store.getters['dashboard/full_new_students']
    }
  },
  watch: {
    is_active (new_v) {
      if (new_v) {
        this.$store.dispatch('dashboard/get_full_new_students').then(res => {
          // console.log('res', res)
          /*
           *  After taking programs
           */
        })
      }
    }
  },
  created () {
    bus.$on('dialog:new_students', (payload) => {
      this.is_active = true
    })
  }
}
</script>