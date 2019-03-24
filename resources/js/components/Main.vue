<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <v-list>
        <v-list-tile @click="$router.push({ name: 'dashboard' })">
          <v-list-tile-action>
            <v-icon>dashboard</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Dashboard</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="$router.push({ name: 'student.list' })">
          <v-list-tile-action>
            <v-icon>people</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Student</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="$router.push({ name: 'class.list' })">
          <v-list-tile-action>
            <v-icon>school</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Class</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>{{ APP_NAME }}</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu 
        offset-y
      >
        <v-avatar
          slot="activator"
          :size="40"
          color="grey lighten-4"
        >
          <img :src="AVATAR_BASE_URL+'/50/'+user_name+'.png'" alt="avatar">
        </v-avatar>
        <v-card max-width="170">
          <div style="padding: 16px;">
            <h6 class="ca-typo-title-6">Hello {{ user_name }}</h6>
          </div>
          <v-divider style="margin-top: 0px; margin-bottom: 0px;"></v-divider>
          <v-list dense>
            <v-list-tile
              @click="logout()"
            >
              <v-list-tile-title>Logout</v-list-tile-title>
            </v-list-tile>
            <v-list-tile
              @click="$router.push({name: 'account.profile'})"
            >
              <v-list-tile-title>Account</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-card>
      </v-menu>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout>
          <v-flex>
            <router-view :key="$route.fullPath"></router-view>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer app color="indigo" class="pa-3">
      <v-spacer></v-spacer>
      <div class="white--text">&copy; {{ new Date().getFullYear() }}</div>
    </v-footer>
  </v-app>
</template>
<script>
  export default {
    data: () => ({
      drawer: null
    }),
    computed: {
      user_email () {
        return this.$store.getters['account/user'].email
      },
      user_name () {
        return this.$store.getters['account/user'].first_name
      }
    },
    methods: {
      logout () {
        this.$store.dispatch('destroyToken').then(() => {
          this.$router.push({name: 'login'})
        })
      }
    },
    created () {
      this.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.getters.token
    }
  }
</script>
<style>
  #inspire {
    background: #f3f3f3;
  }
</style>