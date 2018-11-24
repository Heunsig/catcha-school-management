<template>
  <v-form v-model="valid">
    <v-card>
      <v-card-text>
        <v-container fluid>
          <v-layout wrap>
            <v-flex xs12>
              <v-text-field
                v-model="email"
                label="Email"
                counter
                maxlength="120"
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
                maxlength="120"
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
                maxlength="120"
                required
              ></v-text-field>
            </v-flex>
            <v-flex xs4>
              <v-text-field
                v-model="first_name"
                label="First Name"
                counter
                maxlength="50"
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
              >
              </v-text-field>
            </v-flex>
            <v-flex xs4>
              <v-text-field
                v-model="last_name"
                label="Last Name"
                counter
                maxlength="50"
              >
              </v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field
                v-model="nickname"
                label="Nick Name"
                counter
                maxlength="50"
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
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
  </v-form>
</template>
<script>
export default {
  data: () => ({
    valid: false,
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
  })
}
</script>