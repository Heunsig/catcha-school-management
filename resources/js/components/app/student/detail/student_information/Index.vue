<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <ul class="insty-ul">
          <li class="ca-cursor-pointer" @click="$router.push({name: 'student.information.basic_information', params:{student_id: $route.params.student_id}})">Basic information</li>
          <li class="ca-cursor-pointer" @click="$router.push({name: 'student.information.contact', params:{student_id: $route.params.student_id}})">Contact</li>
          <li class="ca-cursor-pointer" @click="$router.push({name: 'student.information.address', params:{student_id: $route.params.student_id}})">Address</li>
          <li class="ca-cursor-pointer" @click="$router.push({name: 'student.information.emergency_contact', params:{student_id: $route.params.student_id}})">Emergency Contact</li>
        </ul>
      </v-flex>
      <v-flex xs12>
        <router-view :key="$route.fullPath"></router-view>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<style scoped>
  .insty-ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .insty-ul > li {
    display: inline-block;
    margin-right: 15px;
  }

  .insty-ul > li:last-child {
    margin-right: 0px;
  }
</style>