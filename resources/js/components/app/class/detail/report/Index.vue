<template>
  <v-container fluid class="pa-0 ca-grid-list-3-y">
    <v-layout wrap>
      <v-flex xs12>
        <v-card>
          <v-card-text>
            Report
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs3>
        <v-card>
          <v-card-title>
            Group By
          </v-card-title>
          <v-card-text>
            <v-list>
              <v-list-tile @click="">
                <v-list-tile-content>
                  <v-list-tile-title v-text="'Student'"></v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile @click="">
                <v-list-tile-content>
                  <v-list-tile-title v-text="'Grade group'"></v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs9>
        <v-card>
          <v-card-title>
            
          </v-card-title>
          <v-card-text>
            <router-view :key="$route.fullPath"></router-view>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>