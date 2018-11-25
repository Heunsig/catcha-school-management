<template>
  <v-form>
    <v-card>
      <v-card-text>
        <v-container fluid>
          <v-layout wrap>
            <v-flex xs12>
              <v-text-field
                v-model="email"
                label="Email"
                data-vv-name="email"
                :error-messages="errors.collect('email')"
                v-validate="'required|email'"
                required
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                v-model="password"
                label="Password"
                :append-icon="is_ps_shown ? 'visibility' : 'visibility_off'"
                :type="is_ps_shown ? 'text' : 'password'"
                @click:append="is_ps_shown = !is_ps_shown"
                counter
                maxlength="40"
                data-vv-name="password"
                :error-messages="errors.collect('password')"
                v-validate="'required|min:8|max:40'"
                ref="password"
                required
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                v-model="password_confirmation"
                label="Confirm Password"
                :append-icon="is_psc_shown ? 'visibility' : 'visibility_off'"
                :type="is_psc_shown ? 'text' : 'password'"
                @click:append="is_psc_shown = !is_psc_shown"
                counter
                maxlength="40"
                data-vv-name="password confirmation"
                :error-messages="errors.collect('password confirmation')"
                v-validate="'required|confirmed:password'"
                required
              ></v-text-field>
            </v-flex>
            <v-flex xs4>
              <v-text-field
                v-model="first_name"
                label="First Name"
                counter
                maxlength="50"
                data-vv-name="first name"
                :error-messages="errors.collect('first name')"
                v-validate="'required|max:50'"
                required
              >
              </v-text-field>
            </v-flex>
            <v-flex xs4>
              <v-text-field
                v-model="middle_name"
                label="Middle Name"
                counter
                maxlength="50"
                data-vv-name="middle name"
                :error-messages="errors.collect('middle name')"
                v-validate="'max:50'"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs4>
              <v-text-field
                v-model="last_name"
                label="Last Name"
                counter
                maxlength="50"
                data-vv-name="last name"
                :error-messages="errors.collect('last name')"
                v-validate="'max:50'"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                v-model="nickname"
                label="Nickname"
                counter
                maxlength="50"
                data-vv-name="nickname"
                :error-messages="errors.collect('nickname')"
                v-validate="'max:50'"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-textarea
                v-model="note"
                label="Note"
              >
              </v-textarea>
            </v-flex>
            <v-flex xs12>
              <v-card class="elevation-0 transparent">
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="submit()" color="primary">submit</v-btn>
                  <v-btn @click="clear()">clear</v-btn>  
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
  </v-form>
</template>
<script>
export default {
  data: () => ({
    email: '',
    password: '',
    password_confirmation: '',
    first_name: '',
    middle_name: '',
    last_name: '',
    nickname: '',
    note: '',
    is_ps_shown: false,
    is_psc_shown: false,
  }),
  methods: {
    submit () {
      this.$validator.validateAll().then(result => {
        if (result) {
          // Success
        } else {
          // Failure
        }
      })
    },
    clear () {
      this.email = ''
      this.password = ''
      this.password_confirmation = ''
      this.first_name = ''
      this.middle_name = ''
      this.last_name = ''
      this.nickname = ''
      this.note = ''
      this.$validator.reset()
    }
  }
}
</script>