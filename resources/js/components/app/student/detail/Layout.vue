<template>
  <v-container fluid class="pa-0 ca-grid-list-3">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">{{ student.full_name }}'s Details</h1>
              <CaBreadcrumbs :items="breadcrumbs"></CaBreadcrumbs>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs3>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <v-img :src="AVATAR_BASE_URL + '/510/'+ student.full_name +'.png'" aspect-ratio="1.3"></v-img>
                <v-card-text>
                  <div class="mb-1">
                    <span class="ca-typo-title-5">{{ student.type.name }}</span> <span class="ca-typo-title-5">/</span> <span class="ca-typo-title-5">{{ student.status.name }}</span>
                  </div>
                  <div class="ca-typo-title-3 mb-2">
                    <v-tooltip bottom>
                      <span slot="activator" class="flag-icon" :class="'flag-icon-'+get_flag_code(get_country(student.country_of_citizenship).code)"></span>
                      <span>{{ get_country(student.country_of_citizenship).name }}</span>
                    </v-tooltip>
                    {{ student.full_name }}
                    <small class="ml-1" v-if="student.nickname">({{ student.nickname }})</small>
                  </div>
                </v-card-text>
              </v-card>
            </v-flex>
            <!-- <v-flex xs12>
              <v-card>
                <v-card-title>
                  <div class="ca-typo-title-4">Latest activity</div>
                </v-card-title>
                <v-card-text>
                  <latest-activity-list></latest-activity-list>
                </v-card-text>
                <v-card-actions>
                  <v-btn depressed small block color="transparent" class="blue--text">More</v-btn>
                </v-card-actions>
              </v-card>
            </v-flex> -->
          </v-layout>
        </v-container>
      </v-flex>
      <v-flex xs9>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <ul class="ca-tab">
                  <li class="ca-tab-item" :class="{'ca-active':is_active('profile')}" @click="$router.push({name: 'student.information.basic_information', params:{student_id: $route.params.student_id}})">Profile</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('class')}" @click="$router.push({name: 'student.class', params:{student_id: $route.params.student_id}})">Program & Class</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('invoice')}" @click="$router.push({name: 'student.invoice', params:{student_id: $route.params.student_id}})">Payment</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('leave')}" @click="$router.push({name: 'student.leave', params:{student_id: $route.params.student_id}})">Leave</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('document')}" @click="$router.push({name: 'student.document', params:{student_id: $route.params.student_id}})">Document</li>
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
import LatestActivityList from './particles/latest_activity/List'
import countriesMixin from '../../../../mixins/countries'

export default {
  mixins: [
    countriesMixin
  ],
  components: {
    LatestActivityList
  },
  data: () => ({
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false
      },
      {
        text: 'Student',
        disabled: false
      }
    ]
  }),
  computed: {
    student () {
      return this.$store.getters['student/student']
    }
  },
  methods: {
    is_active (name) {
      let parent_path = this.$route.fullPath.split('/')[3]
      if(parent_path === name) {
        return true  
      } 
      return false
    }
  },
  created () {
    this.breadcrumbs.push({
      text: this.student.full_name,
      disabled: true
    })
  }
}
</script>