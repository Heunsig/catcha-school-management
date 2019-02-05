<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">Student</h1>
              <v-breadcrumbs :items="breadcrumbs" class="ca-breadcrumbs">
                <template slot="item" slot-scope="props">
                  <span v-if="props.item.disabled" :class="[props.item.disabled && 'ca-disabled']">{{ props.item.text }}</span>
                  <a v-else @click="">{{ props.item.text }}</a>
                </template>
              </v-breadcrumbs>
            </div>
            <v-spacer></v-spacer>
              <div class="insty-tool-box">
                <el-input
                  v-model="search"
                  placeholder="Search"
                  suffix-icon="el-icon-search"
                ></el-input>
                <v-btn 
                  color="primary" 
                  @click="$router.push({name: 'student.registration'})"
                >
                  Add Student
                </v-btn>
              </div>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs12>
        <v-card>
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
              <td>{{ props.item.status }}</td>
              <td>{{ $moment(props.item.created_at).format('MM/DD/YYYY') }}</td>
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
        text: 'Status',
        value: 'status.name'
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
    },
    // test () {
    //   this.$axios.put(`/leave/1/program`,{
    //     test: 'hi'
    //   }).then(res => {
    //     console.log('res', res)
    //   })
    // }
  },
  created () {
    this.$axios.get('/student').then(res => {
      console.log('res', res)
      this.students = res.data
    })
  }
}
</script>
<style>
  .insty-tool-box {
    display: flex;
    align-items: center;
  }
</style>