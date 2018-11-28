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
              <v-btn color="primary">Register New Student</v-btn>
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
          >
            <template slot="items" slot-scope="props">
              <td>
                <v-avatar
                  :size="45"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL+'/50/Heunsig.png'" alt="avatar"/>
                </v-avatar>
              </td>
              <td>{{ props.item.user.full_name }}</td>
              <td>{{ props.item.user.email }}</td>
              <td>{{ props.item.status }}</td>
              <td>
                <v-btn icon>
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
    headers: [
      {
        text: '',
        sortable: false,
      },
      {
        text: 'Name',
        value: 'user.full_name'
      },
      {
        text: 'Email',
        value: 'user.email'
      },
      {
        text: 'Birth Day',
        value: 'birth_day'
      },
      {
        text: 'Actions',
        sortable: false
      }
    ],
    students: [
      // {
      //   name: 'Heunsig',
      //   email: 'heun3344@gmail.com',
      //   birth_day: '12/26/1990'
      // }
    ]
  }),
  created () {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.getters.token
    axios.get('/student').then(res => {
      console.log('res', res)
      this.students = res.data
    })
  }
}
</script>