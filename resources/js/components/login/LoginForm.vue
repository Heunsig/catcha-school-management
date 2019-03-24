<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height class="pa-0">
        <v-layout wrap align-center justify-center>
          <v-flex xs6 style="height:100%;background: url('https://lv7ms1pq6dm2sea8j1mrajzw-wpengine.netdna-ssl.com/wp-content/uploads/2017/01/summer-programs.jpg') #67ccc9;background-size: cover;">
            <!-- <div style="color: #fff;font-size: 50px;position: absolute;top: 20px;left: 20px;">Mentor Language Institute</div> -->
            <!-- <div style="height:100%;width:100%;background: rgba(0, 0, 0, 0.3);"></div> -->
            <!-- Mentor Language Institute -->
          </v-flex>
          <!-- <v-flex xs6 sm8 md4> -->
          <v-flex xs6 style="padding: 150px;">
            <v-card class="elevation-0 transparent">
              <!-- <v-toolbar dark color="primary">
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar> -->
              <div style="text-align: center;font-size: 30px; color:#5d5d5d;">
                Mentor Language Institute
              </div>
              <v-card-text>
                <v-form
                  ref="form"
                  v-model="valid"
                >
                  <v-text-field 
                    v-model="email"
                    label="Email" 
                    type="text"
                    :rules="emailRules"
                  ></v-text-field>
                  <v-text-field 
                    v-model="password" 
                    label="Password" 
                    type="password"
                    :rules="passwordRules"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn 
                  color="primary" 
                  :loading="wating_result"
                  block
                  depressed
                  @click="login()"
                >Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      email: '',
      password: '',
      wating_result: false,
      valid: false,
      emailRules: [
        v => !!v || 'Email is required',
      ],
      passwordRules: [
        v => !!v || 'Password is required',
      ],
    }),
    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      login () {
        if (this.$refs.form.validate()) {
          this.wating_result = true
          this.$store.dispatch('retrieveToken', {
            username: this.email,
            password: this.password
          }).then(token => {
            if (this.$route.query.redirect) {
              this.$router.push({path: this.$route.query.redirect})
            } else {
              this.$router.push({name: 'dashboard'})
            }
          })
        }
      }
    }
  }
</script>