<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-typo-title-1">Account</h1>
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
      <v-flex xs12>
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs3>
              <v-list dense>
                <v-list-tile @click="$router.push({name: 'account.profile'})">
                  <v-list-tile-content>
                    <v-list-tile-title>Profile</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="$router.push({name: 'account.security'})">
                  <v-list-tile-content>
                    <v-list-tile-title>Security</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-flex>
            <v-flex xs9>
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
          text: 'Account',
          disabled: true,
        }
      ]
    }
  }
}
</script>