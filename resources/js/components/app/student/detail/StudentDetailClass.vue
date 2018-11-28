<template>
  <v-card>
    <v-card-title>
      <div class="ca-title-4">Class</div>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" persistent max-width="350">
        <v-btn slot="activator" color="primary" dark>Add Class</v-btn>
        <v-card>
          <v-card-title class="ca-title-4">Add New Class</v-card-title>
          <v-card-text>
            <v-container fluid class="pa-0">
              <v-layout wrap>
                <v-flex xs12>
                  <v-select
                    :items="classes"
                    item-text="name"
                    item-value="id"
                    label="Choose Class"
                  ></v-select>
                </v-flex>
                <v-flex xs12>
                  <v-menu
                    :close-on-content-click="false"
                    v-model="date_picker"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    min-width="290px"
                  >
                    <v-text-field
                      slot="activator"
                      v-model="start_date"
                      label="When does this student begin the class?"
                      prepend-icon="event"
                      readonly
                    ></v-text-field>
                    <v-date-picker v-model="start_date" @input="date_picker = false"></v-date-picker>
                  </v-menu>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat @click="dialog = false">Disagree</v-btn>
            <v-btn color="green darken-1" flat @click="dialog = false">Agree</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
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
<script>
export default {
  data:() => ({
    dialog: false,
    date_picker: false,
    start_date: '',
    classes: []
  }),
  created () {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.getters.token
    axios.get(`${this.AXIOS_BASE_URL}/class`).then(res => {
      console.log('res', res)
      this.classes = res.data
    })
  }
}
</script>