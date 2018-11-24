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
          <img src="http://lorempixel.com/40/40" alt="avatar">
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
    <v-footer color="indigo" app>
      <span class="white--text">&copy; 2017</span>
    </v-footer>
  </v-app>
</template>
<script>
  export default {
    data: () => ({
      drawer: null
    }),
    computed: {
      APP_NAME () {
        return config.APP_NAME
      }
    },
    methods: {
      logout () {
        this.$store.dispatch('destroyToken').then(() => {
          this.$router.push({name: 'login'})
        })
      }
    }
  }
</script>
