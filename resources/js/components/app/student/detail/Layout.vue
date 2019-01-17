<template>
  <v-container fluid class="pa-0 ca-grid-list-3">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">{{ full_name }}'s Details</h1>
              <v-breadcrumbs :items="breadcrumbs" class="ca-breadcrumbs">
                <template slot="item" slot-scope="props">
                  <span v-if="props.item.disabled" :class="[props.item.disabled && 'ca-disabled']">{{ props.item.text }}</span>
                  <a v-else @click="">{{ props.item.text }}</a>
                </template>
              </v-breadcrumbs>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
      <v-flex xs3>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <v-img :src="AVATAR_BASE_URL + '/510/'+ full_name +'.png'" aspect-ratio="1.3"></v-img>
                <v-card-text>
                  <div class="ca-typo-title-3 mb-2">
                    <span class="flag-icon flag-icon-kr"></span>
                    {{ full_name }}
                    <small class="ml-1" v-if="nickname">({{ nickname }})</small>
                  </div>
                  <div class="ca-typo-style-meta-medium">
                    {{ email }}
                  </div>
                  <div class="ca-typo-style-meta-medium">
                    217-760-1587
                  </div>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12>
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
            </v-flex>
          </v-layout>
        </v-container>
      </v-flex>
      <v-flex xs9>
        <v-container fluid class="pa-0 ca-grid-list-3-y">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <ul class="ca-tab">
                  <li class="ca-tab-item" :class="{'ca-active':is_active('')}" @click="$router.push({name: 'student.basic_information', params:{student_id: $route.params.student_id}})">Basic Information</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('class')}" @click="$router.push({name: 'student.class', params:{student_id: $route.params.student_id}})">Class</li>
                  <li class="ca-tab-item" :class="{'ca-active':is_active('invoice')}" @click="$router.push({name: 'student.invoice', params:{student_id: $route.params.student_id}})">Payment</li>
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
export default {
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
    full_name () {
      return this.$store.getters['student/basic_information'].full_name
    },
    nickname () {
      return this.$store.getters['student/basic_information'].nickname
    },
    email () {
      return this.$store.getters['student/basic_information'].email
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
    this.$store.dispatch('student/get_student', {
      student_id: this.$route.params.student_id
    }).then(res => {
      this.breadcrumbs.push({
        text: this.full_name,
        disabled: true
      })
    })
  }
}
</script>