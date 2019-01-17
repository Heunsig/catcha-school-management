<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-title-1">Student</h1>
              <v-breadcrumbs :items="breadcrumbs" class="ca-breadcrumbs">
                <template slot="item" slot-scope="props">
                  <span v-if="props.item.disabled" :class="[props.item.disabled && 'ca-disabled']">{{ props.item.text }}</span>
                  <a v-else @click="">{{ props.item.text }}</a>
                </template>
              </v-breadcrumbs>
            </div>
            <v-spacer></v-spacer>
              <v-btn 
                color="primary" 
                depressed
                @click="$router.push({name: 'student.registration'})"
              >
                Register New Student
              </v-btn>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs12>
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
          <v-data-table
            :headers="headers"
            :items="students"
            :search="search"
            :rows-per-page-items="RPPI"
            :pagination.sync="pagination"
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
              <td>{{ props.item.type }}</td>
              <td>{{ props.item.full_name }}</td>
              <td>{{ props.item.email }}</td>
              <td>{{ props.item.status.name }}</td>
              <td>{{ props.item.birth_day }}</td>
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
        </v-card>
      </v-flex>
    </v-layout>
    <v-dialog v-model="big_image_dialog" max-width="400">
      <img :src="image_src" alt="avatar"/>
    </v-dialog>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false,
      },
      {
        text: 'Student',
        disabled: true,
      }
    ],
    search: '',
    pagination: {
      descending: true,
      sortBy: 'hidden_created_at'
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
        text: 'Name',
        value: 'full_name'
      },
      {
        text: 'Email',
        value: 'email'
      },
      {
        text: 'Status',
        value: 'status.name'
      },
      {
        text: 'Birth Day',
        value: 'birth_day'
      },
      {
        text: 'Created At',
        value: 'hidden_created_at'
      },
      {
        text: 'Actions',
        sortable: false
      }
    ],
    students: [],
    big_image_dialog: false,
    image_src: ''
  }),
  methods: {
    open_big_img (src) {
      console.log('src', src)
      this.big_image_dialog = true
      this.image_src = src
      // console.log('Hello World')
    }
  },
  created () {
    this.$axios.get('/student').then(res => {
      console.log('res', res)
      this.students = res.data
    })
  }
}
</script>