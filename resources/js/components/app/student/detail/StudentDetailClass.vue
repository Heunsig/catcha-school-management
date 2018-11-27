<template>
  <v-card>
    <v-card-title>
      <div class="ca-title-4">Class</div>
      <v-spacer></v-spacer>
      <v-btn depressed color="primary">Add</v-btn>
    </v-card-title>
    <v-card-text>
      <div class="ca-class-process">
        <div class="ca-class-process-header">
          <div class="ca-class-process-header-title ca-title-3">Process 1</div>
        </div>
        <div class="ca-class ca-done elevation-4">
          <div class="ca-class-header">
            <div class="ca-title-4">Beginning Track 1</div>
            <v-spacer></v-spacer>
            <v-btn icon>
              <v-icon color="grey">edit</v-icon>
            </v-btn>
            <v-btn icon>
              <v-icon color="grey">remove</v-icon>
            </v-btn>
          </div>
          <div class="ca-class-footer">
            <div>
              11/01/2018 - 11/30/2018
              <div>(25days, or 3weeks and 4days )</div>
            </div>
            <v-spacer></v-spacer>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Created By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Updated By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Deleted By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <!-- <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar"> -->
                </v-avatar>
              </div>
            </div>
          </div>
        </div>
        <div class="ca-class ca-working elevation-4">
          <div class="ca-class-header">
            <div class="ca-title-4">Beginning Track 2</div>
            <v-spacer></v-spacer>
            <v-btn icon>
              <v-icon color="grey">edit</v-icon>
            </v-btn>
            <v-btn icon>
              <v-icon color="grey">remove</v-icon>
            </v-btn>
          </div>
          <div class="ca-class-footer">
            <div>
              11/01/2018 - 11/30/2018
              <div>(25days, or 3weeks and 4days )</div>
            </div>
            <v-spacer></v-spacer>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Created By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Updated By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Deleted By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <!-- <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar"> -->
                </v-avatar>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ca-class-process">
        <div class="ca-class-process-header">
          <div class="ca-class-process-header-title ca-title-3">Process 2</div>
        </div>
        <div class="ca-class ca-done elevation-4">
          <div class="ca-class-header">
            <div class="ca-title-4">Beginning Track 1</div>
            <v-spacer></v-spacer>
            <v-btn icon>
              <v-icon color="grey">edit</v-icon>
            </v-btn>
            <v-btn icon>
              <v-icon color="grey">remove</v-icon>
            </v-btn>
          </div>
          <div class="ca-class-footer">
            <div>
              11/01/2018 - 11/30/2018
              <div>(25days, or 3weeks and 4days )</div>
            </div>
            <v-spacer></v-spacer>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Created By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Updated By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Deleted By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <!-- <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar"> -->
                </v-avatar>
              </div>
            </div>
          </div>
        </div>
        <div class="ca-class ca-deleted elevation-4">
          <div class="ca-class-header">
            <div class="ca-title-4">Beginning Track 2</div>
            <v-spacer></v-spacer>
            <v-btn icon>
              <v-icon color="grey">edit</v-icon>
            </v-btn>
            <v-btn icon>
              <v-icon color="grey">remove</v-icon>
            </v-btn>
          </div>
          <div class="ca-class-footer">
            <div>
              11/01/2018 - 11/30/2018
              <div>(25days, or 3weeks and 4days )</div>
            </div>
            <v-spacer></v-spacer>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Created By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Updated By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-4"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
            <div class="ca-tracking-box">
              <div class="ca-tracking-box-title">Deleted By</div>
              <div class="ca-tracking-box-avatar">
                <v-avatar
                  size="30"
                  color="grey lighten-2"
                >
                  <img :src="AVATAR_BASE_URL + '/40/Heunsig.png'" alt="avatar">
                </v-avatar>
              </div>
            </div>
          </div>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>