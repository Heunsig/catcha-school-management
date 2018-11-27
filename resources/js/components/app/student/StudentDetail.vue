<template>
  <v-container grid-list-lg fluid class="pa-0">
    <v-layout wrap>
      <v-flex xs12>
        <v-card class="elevation-0 transparent">
          <v-card-title>
            <div>
              <h1 class="ca-title-1">Heunsig's Details</h1>
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
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <v-img src="https://picsum.photos/510/600?random" aspect-ratio="1.3"></v-img>
                <v-card-text>
                  <div class="ca-title-3 mb-2 ca-c-name">
                    <span class="flag-icon flag-icon-kr"></span>
                    Heunsig Jo Hidne osheoe ajsmdmdeyrmd dhe<small class="ml-1">(Joe)</small>
                  </div>
                  <div class="ca-title-5">
                    heun3344@gmail.com
                  </div>
                  <div class="ca-title-5">
                    217-760-1587
                  </div>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12>
              <v-card>
                <v-card-title>
                  <div class="ca-title-4">Latest activity</div>
                </v-card-title>
                <v-card-text>
                  <ul class="ca-list">
                    <li class="ca-list-item">
                      <div class="ca-list-item-avatar">
                        <v-avatar
                          size="30"
                          color="grey lighten-4"
                        >
                          <img :src="AVATAR_BASE_URL + '/50/Heunsig.png'" alt="avatar">
                        </v-avatar>
                      </div>
                      <div class="ca-list-item-content">
                        <div class=""><strong>Heunsig</strong> Created this stduent's profile</div>
                        <div class="ca-typo-meta">11/25/2018</div>
                      </div>
                    </li>
                    <li class="ca-list-item">
                      <div class="ca-list-item-avatar">
                        <v-avatar
                          size="30"
                          color="grey lighten-4"
                        >
                          <img :src="AVATAR_BASE_URL + '/50/Heunsig.png'" alt="avatar">
                        </v-avatar>
                      </div>
                      <div class="ca-list-item-content">
                        <div class=""><strong>Heunsig</strong> Created this stduent's profile</div>
                        <div class="ca-typo-meta">11/25/2018</div>
                      </div>
                    </li>
                    <li class="ca-list-item">
                      <div class="ca-list-item-avatar">
                        <v-avatar
                          size="30"
                          color="grey lighten-4"
                        >
                          <img :src="AVATAR_BASE_URL + '/50/Heunsig.png'" alt="avatar">
                        </v-avatar>
                      </div>
                      <div class="ca-list-item-content">
                        <div class=""><strong>Heunsig</strong> Created this stduent's profile</div>
                        <div class="ca-typo-meta">11/25/2018</div>
                      </div>
                    </li>
                    <li class="ca-list-item">
                      <div class="ca-list-item-avatar">
                        <v-avatar
                          size="30"
                          color="grey lighten-4"
                        >
                          <img :src="AVATAR_BASE_URL + '/50/Heunsig.png'" alt="avatar">
                        </v-avatar>
                      </div>
                      <div class="ca-list-item-content">
                        <div class=""><strong>Heunsig</strong> Created this stduent's profile</div>
                        <div class="ca-typo-meta">11/25/2018</div>
                      </div>
                    </li>
                    <li class="ca-list-item">
                      <div class="ca-list-item-avatar">
                        <v-avatar
                          size="30"
                          color="grey lighten-4"
                        >
                          <img :src="AVATAR_BASE_URL + '/50/Heunsig.png'" alt="avatar">
                        </v-avatar>
                      </div>
                      <div class="ca-list-item-content">
                        <div class=""><strong>Heunsig</strong> Created this stduent's profile</div>
                        <div class="ca-typo-meta">11/25/2018</div>
                      </div>
                    </li>
                  </ul>
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
        <v-container fluid class="pa-0">
          <v-layout wrap>
            <v-flex xs12>
              <v-card>
                <ul class="ca-tab">
                  <li class="ca-tab-item ca-active">Basic Information</li>
                  <li class="ca-tab-item">Class</li>
                  <li class="ca-tab-item">Payment</li>
                </ul>
              </v-card>
            </v-flex>
            <v-flex xs12>
              <v-card>
                <v-card-title>
                  <div class="ca-title-4">Basic Information</div>
                </v-card-title>
                <v-card-text>
                  <v-container fluid class="pa-0">
                    <v-layout wrap>
                      <v-flex xs12>
                        <div class="ca-label">
                          <div class="ca-label-title ca-title-5">Email</div>
                          <div class="ca-label-content">heun3344@gmail.com</div>
                        </div>
                      </v-flex>
                      <v-flex xs4>
                        <div class="ca-label">
                          <div class="ca-label-title ca-title-5">First Name</div>
                          <div class="ca-label-content">Heunsig</div>
                        </div>
                      </v-flex>
                      <v-flex xs4>
                        <div class="ca-label">
                          <div class="ca-label-title ca-title-5">Middle Name</div>
                          <div class="ca-label-content"></div>
                        </div>
                      </v-flex>
                      <v-flex xs4>
                        <div class="ca-label">
                          <div class="ca-label-title ca-title-5">Last Name</div>
                          <div class="ca-label-content">Jo</div>
                        </div>
                      </v-flex>
                      <v-flex xs12>
                        <div class="ca-label">
                          <div class="ca-label-title ca-title-5">Nickname</div>
                          <div class="ca-label-content">Joe</div>
                        </div>
                      </v-flex>
                      <v-flex xs12>
                        <div class="ca-label ca-label-wrap">
                          <div class="ca-label-title ca-title-5">Note</div>
                          <div class="ca-label-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                        </div>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false
      },
      {
        text: 'student',
        disabled: false
      },
      {
        text: 'Heunsig',
        disabled: true
      }
    ]
  })
}
</script>