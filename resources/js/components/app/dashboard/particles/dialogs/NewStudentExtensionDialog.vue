<template>
  <v-dialog v-model="is_active" scrollable persistent max-width="1000">
    <v-card>
      <v-card-title>
        hi
      </v-card-title>
      <v-card-text>
        <v-data-table
          :headers="headers"
          :items="full_new_students"
          :search="search"
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
            <td>{{ props.item.full_name }}</td>
            <td>{{ props.item.type }}</td>
            <td>{{ props.item.email }}</td>
            <td>{{ props.item.created_at }}</td>
            <td>
              <v-btn 
                icon
                @click="$router.push({
                  name: 'student.basic_information',
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
      is_active: false,
      search: '',
      headers: [
        {
          text: '',
          sortable: false,
        },
        {
          text: 'Name',
          value: 'full_name'
        },
        {
          text: 'Type',
          value: 'type'
        },
        {
          text: 'Email',
          value: 'email'
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
          /*
           *  After taking programs
           */
        })
      }
    }
  },
  created () {
    bus.$on('open_dialog_for_new_students_extension', (payload) => {
      this.is_active = true
    })
  }
}
</script>