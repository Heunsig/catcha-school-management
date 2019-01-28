<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <v-list dense>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon>dashboard</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Dashboard</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="$router.push({ name: 'student' })">
          <v-list-tile-action>
            <v-icon>people</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Student</v-list-tile-title>
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
          <img :src="AVATAR_BASE_URL+'/50/Heunsig.png'" alt="avatar">
        </v-avatar>
        <v-card>
          <v-list dense>
            <v-list-tile
              @click=""
            >
              <v-list-tile-title>Signed in as Heunsig</v-list-tile-title>
            </v-list-tile>
          </v-list>
          <v-divider></v-divider>
          <v-list dense>
            <v-list-tile
              @click="logout()"
            >
              <v-list-tile-title>Logout</v-list-tile-title>
            </v-list-tile>
            <v-list-tile
              @click=""
            >
              <v-list-tile-title>Settings</v-list-tile-title>
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
