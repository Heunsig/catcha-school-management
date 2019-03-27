<template>
  <v-container fluid class="pa-0 ca-grid-list-3">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">Class</h1>
              <CaBreadcrumbs :items="breadcrumbs"></CaBreadcrumbs>
            </div>
            <v-spacer></v-spacer>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs12>
        <v-card>
          <v-data-table
            :headers="headers"
            :items="classes"
            :search="search"
            :loading="loading"
            :rows-per-page-items="RPPI"
            :pagination.sync="pagination"
          >
            <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
            <template slot="items" slot-scope="props">
              <td class="text-xs-center">{{ props.item.name }}</td>
              <td class="text-xs-center">{{ props.item.number_of_students }}</td>
              <td class="text-xs-center">{{ props.item.description }}</td>
              <td class="text-xs-center">
                <v-btn 
                  icon
                  @click="$router.push({name: 'class.student', params: {classinfo_id: props.item.id}})"
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
  </v-container>
</template>
<script>
export default {
  data () {
    return {
      loading: false,
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
        },
        {
          text: 'Class',
          disabled: true,
        }
      ],
      search: '',
      pagination: {
        descending: false,
        sortBy: 'id'
      },
      headers: [
        {
          text: 'Name',
          value: 'name',
          align: 'center',
          width: '280'
        },
        {
          text: 'Number of students',
          value: 'number_of_students',
          width: '160'
        },
        {
          text: 'Description',
          value: 'description',
          align: 'center'
        },
        {
          text: 'Actions',
          width: '120',
          align: 'center',
          sortable: false
        }
      ],
    }
  },
  computed: {
    classes () {
      return this.$store.getters['class/classes']
    }
  },
  created () {
    this.loading = true
    this.$store.dispatch('class/get_classes').then(res => {
      this.loading = false
    })
  }
}
</script>