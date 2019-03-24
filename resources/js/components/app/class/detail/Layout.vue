<template>
  <v-container fluid class="pa-0 ca-grid-list-3">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">{{ classinfo.name }}'s Details</h1>
              <CaBreadcrumbs :items="breadcrumbs"></CaBreadcrumbs>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs12>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <v-card-text>
                  <h4 class="ca-typo-title-4">{{ classinfo.name }}</h4>
                  <div>{{ classinfo.description }}</div>
                </v-card-text>
              </v-card>
            </v-flex>
            <!-- <v-flex xs12>
              <v-card>
                <v-card-title>
                  <h4 class="ca-typo-title-4">Subject</h4>
                </v-card-title>
                <v-card-text>
                  <ul>
                    <li v-for="subject in subjects">
                      {{ subject.name }}
                    </li>
                  </ul>
                </v-card-text>
              </v-card>
            </v-flex> -->
          </v-layout>
        </v-container>
      </v-flex>
      <v-flex xs12>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <ul class="ca-tab">
                  <li class="ca-tab-item" @click="$router.push({name: 'class.student', params: {classinfo_id: $route.params.classinfo_id}})">Student</li>
                  <li class="ca-tab-item" @click="$router.push({name: 'class.grade', params: {classinfo_id: $route.params.classinfo_id, subject_id: 1, date: $moment().format('YYYY-MM-DD')}})">Grade</li>
                  <li class="ca-tab-item" @click="$router.push({name: 'class.report', params: {classinfo_id: $route.params.classinfo_id}})">Report</li>
                </ul>
              </v-card>
            </v-flex>
            <v-flex xs12>
              <router-view :key="$route.fullPath"></router-view>
            </v-flex>
          </v-layout>
        </v-container>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data () {
    return {
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false
        },
        {
          text: 'Class',
          disabled: false
        }
      ]
    }
  },
  computed: {
    classinfo () {
      return this.$store.getters['class/classinfo']
    },
    subjects () {
      return this.classinfo.subjects
    }
  },
  created () {
    this.breadcrumbs.push({
      text: this.classinfo.name,
      disabled: true
    })
  }
}
</script>