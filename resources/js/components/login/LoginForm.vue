<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height class="pa-0">
        <v-layout wrap align-center justify-center>
          <v-flex xs6 style="height:100%;background: #67ccc9;">
          </v-flex>
          <!-- <v-flex xs6 sm8 md4> -->
          <v-flex xs6 style="padding: 150px;">
            <v-card class="elevation-0 transparent">
              <!-- <v-toolbar dark color="primary">
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar> -->
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