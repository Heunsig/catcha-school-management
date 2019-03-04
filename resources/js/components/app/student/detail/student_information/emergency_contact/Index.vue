<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-3">Emergency Contact</div>
      <v-spacer></v-spacer>
      <v-btn 
        icon
        @click="open_dialog_add()"
        v-if="_.isEmpty(emergency_contact)"
      >
        <v-icon small>add</v-icon>
      </v-btn>
      <v-btn 
        icon
        @click="open_dialog_edit()"
        v-if="!_.isEmpty(emergency_contact)"
      >
        <v-icon small>edit</v-icon>
      </v-btn>
      <v-btn 
        icon 
        @click="open_dialog_deletion()"
        v-if="!_.isEmpty(emergency_contact)"
      >
        <v-icon small>close</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-2">
        <v-layout wrap>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Name</div>
              <div class="ca-label-content" v-if="emergency_contact.name">
                <span>{{ emergency_contact.name }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Relationship</div>
              <div class="ca-label-content" v-if="emergency_contact.relationship">
                <span>{{ emergency_contact.relationship }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Contact Number</div>
              <div class="ca-label-content" v-if="emergency_contact.number">
                <!-- <span class="flag-icon" :class="get_flag(get_country_as_dial_code(emergency_contact.country_code).code)"></span> -->
                <v-tooltip bottom>
                  <span slot="activator" class="flag-icon mr-1" :class="get_flag(get_country_as_dial_code(emergency_contact.country_code).code)"></span>
                  <span>{{ get_country_as_dial_code(emergency_contact.country_code).name }}</span>
                </v-tooltip>
                <span>+{{ emergency_contact.country_code }}</span>
                <span>
                  {{ emergency_contact.number }} 
                  <span v-if="emergency_contact.type">
                    ({{ capitalize_first_letter(emergency_contact.type) }})  
                  </span>
                </span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Email</div>
              <div class="ca-label-content" v-if="emergency_contact.email">
                <span>{{ emergency_contact.email }}</span>
              </div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label-title ca-title-5 font-weight-bold">Address</div>
            <template>
              <div class="ca-label-content" v-if="emergency_contact.address_line1">{{ emergency_contact.address_line1 }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </template>
            <div class="ca-label-content" v-if="emergency_contact.address_line2">{{ emergency_contact.address_line2 }}</div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">City</div>
              <div class="ca-label-content" v-if="emergency_contact.city">{{ emergency_contact.city }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">State</div>
              <div class="ca-label-content" v-if="emergency_contact.state">{{ emergency_contact.state }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Country</div>
              <div class="ca-label-content" v-if="emergency_contact.country">{{ get_country(emergency_contact.country).name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Postal Code</div>
              <div class="ca-label-content" v-if="emergency_contact.postal_code">{{ emergency_contact.postal_code }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <EmergencyAdditionDialog
      :relationship_options="relationship_options"
      :types="types"
    ></EmergencyAdditionDialog>
    <EmergencyEditDialog
      :relationship_options="relationship_options"
      :types="types"
    ></EmergencyEditDialog>
    <EmergencyDeletionDialog></EmergencyDeletionDialog>
  </v-card>
</template>
<script>
import bus from 'bus'
import countries from '../../../../../../mixins/countries'
import EmergencyAdditionDialog from './EmergencyAdditionDialog'
import EmergencyEditDialog from './EmergencyEditDialog'
import EmergencyDeletionDialog from './EmergencyDeletionDialog'
export default {
  mixins: [
    countries
  ],
  components: {
    EmergencyAdditionDialog,
    EmergencyEditDialog,
    EmergencyDeletionDialog
  },
  data () {
    return {
      relationship_options: ['Father', 'Mother', 'Friend', 'ETC'],
      types: ['Cellphone', 'Phone', 'Fax'],
    }
  },
  computed: {
    emergency_contact () {
      return this.$store.getters['student/emergency_contact']
    }
  },
  methods: {
    get_flag (code) {
      return code ? 'flag-icon-' + code.toLowerCase():null
    },
    open_dialog_add () {
      bus.$emit('open_dialog_emergency_add')
    },
    open_dialog_edit () {
      bus.$emit('open_dialog_emergency_edit', {
        emergency_contact_id: this.emergency_contact.id,
        form: {
          name: this.emergency_contact.name,
          relationship: this.relationship_options.includes(this.emergency_contact.relationship) ? this.emergency_contact.relationship : 'ETC',
          etc: this.emergency_contact.relationship,
          country_code: this.emergency_contact.country_code,
          number: this.emergency_contact.number,
          type: this.emergency_contact.type,
          email: this.emergency_contact.email,
          address_line1: this.emergency_contact.address_line1,
          address_line2: this.emergency_contact.address_line2,
          city: this.emergency_contact.city,
          state: this.emergency_contact.state,
          postal_code: this.emergency_contact.postal_code,
          country: this.emergency_contact.country
        }
      })
    },
    open_dialog_deletion () {
      bus.$emit('open_dialog_emergency_delete', {
        emergency_contact_id: this.emergency_contact.id
      });
    }
  },
  created () {
    this.$store.dispatch('student/get_emergency_contact', {
      student_id: this.$route.params.student_id
    })
  }
}
</script>
