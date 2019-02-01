<template>
  <v-dialog v-model="is_active" scrollable persistent max-width="1000">
    <v-card>
      <v-card-title>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-card-text>
        <v-data-table
          :headers="headers"
          :items="full_coming_leaves"
          :search="search"
          :rows-per-page-items="RPPI"
        >
          <template slot="items" slot-scope="props">
            <td>
              <v-btn 
                fab 
                icon
                @click="open_big_img(AVATAR_BASE_URL+'/400/'+props.item.student.full_name)"
              >
                <v-avatar
                  size="45"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL+'/50/'+props.item.student.full_name" :alt="props.item.student.full_name"/>
                </v-avatar>
              </v-btn>
            </td>
            <td>{{ props.item.student.full_name }}</td>
            <td>{{ props.item.leave_type }}</td>
            <td>{{ props.item.start_date }}</td>
            <td>{{ props.item.completion_date }}</td>
            <td>
              <v-btn 
                icon
                @click="$router.push({
                  name: 'student.basic_information',
                  params: {
                    student_id: props.item.student.id
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
        <v-btn color="green darken-1" flat @click="is_active = false">Close</v-btn>
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
      headers: [
        {
          text: '',
          sortable: false,
        },
        {
          text: 'Name',
          value: 'student.full_name'
        },
        {
          text: 'Leave Type',
          value: 'leave_type'
        },
        {
          text: 'Start Date',
          value: 'start_date'
        },
        {
          text: 'Completion Date',
          value: 'completion_date'
        },
        {
          text: 'Actions',
          sortable: false
        }
      ],
    }
  },
  computed: {
    full_coming_leaves () {
      return this.$store.getters['dashboard/full_coming_leaves']
    }
  },
  watch: {
    is_active (new_v) {
      if (new_v) {
        this.$store.dispatch('dashboard/get_full_coming_leaves').then(res => {
          /*
           *  After taking programs
           */
        })
      }
    }
  },
  created () {
    bus.$on('open_dialog_for_coming_leaves_extension', (payload) => {
      this.is_active = true
    })
  }
}
</script>