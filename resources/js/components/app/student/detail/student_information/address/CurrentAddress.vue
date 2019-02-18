<template>
  <div style="display:flex;align-items: flex-end;">
    <div style="flex:1 1 auto;">
      <h3 class="ca-typo-title-4 mb-1">Current Address</h3>
      <div>
        <v-container fluid class="pa-0 ca-grid-list-2">
          <v-layout wrap>
            <v-flex xs12>
              <div class="ca-label ca-label-wrap">
                <div class="ca-label-title ca-title-5 font-weight-bold">Address</div>
                <template>
                  <div class="ca-label-content" v-if="current_address.address_line1">{{ current_address.address_line1 }}</div>
                  <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
                </template>
                <div class="ca-label-content" v-if="current_address.address_line2">{{ current_address.address_line2 }}</div>
              </div>
            </v-flex>
            <v-flex xs3>
              <div class="ca-label ca-label-wrap">
                <div class="ca-label-title ca-title-5 font-weight-bold">City</div>
                <div class="ca-label-content" v-if="current_address.city">{{ current_address.city }}</div>
                <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
              </div>
            </v-flex>
            <v-flex xs3>
              <div class="ca-label ca-label-wrap">
                <div class="ca-label-title ca-title-5 font-weight-bold">State</div>
                <div class="ca-label-content" v-if="current_address.state">{{ current_address.state }}</div>
                <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
              </div>
            </v-flex>
            <v-flex xs3>
              <div class="ca-label ca-label-wrap">
                <div class="ca-label-title ca-title-5 font-weight-bold">Country</div>
                <div class="ca-label-content" v-if="current_address.country">
                  <v-tooltip bottom>
                    <span slot="activator" class="flag-icon mr-1" :class="get_flag(current_address.country)"></span>
                    <span>{{ get_country(current_address.country).name }}</span>
                  </v-tooltip>
                  {{ get_country(current_address.country).name }}
                </div>
                <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
              </div>
            </v-flex>
            <v-flex xs3>
              <div class="ca-label ca-label-wrap">
                <div class="ca-label-title ca-title-5 font-weight-bold">Postal Code</div>
                <div class="ca-label-content" v-if="current_address.postal_code">{{ current_address.postal_code }}</div>
                <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
              </div>
            </v-flex>
          </v-layout>
        </v-container>
      </div>
    </div>
    <v-spacer></v-spacer>
    <div>
      <v-btn 
        icon
        @click="open_dialog_store()"
        v-if="_.isEmpty(current_address)"
      >
        <v-icon small>add</v-icon>
      </v-btn>
      <v-btn 
        icon
        @click="open_dialog_edit()"
        v-if="!_.isEmpty(current_address)"
      >
        <v-icon small>edit</v-icon>
      </v-btn>
      <v-btn 
        icon
        @click="open_dialog_deletion()"
        v-if="!_.isEmpty(current_address)"
      >
        <v-icon small>close</v-icon>
      </v-btn>
    </div>  
  </div>
</template>
<script>
import bus from 'bus'
import countriesMixin from '../../../../../../mixins/countries'

export default {
  mixins: [
    countriesMixin
  ],
  computed: {
    current_address () {
      return this.$store.getters['student/current_address']
    }
  },
  methods: {
    get_flag (code) {
      return code ? 'flag-icon-' + code.toLowerCase():null
    },
    open_dialog_store () {
      bus.$emit('open_dialog_address_addition', {
        type: 'current'
      })
    },
    open_dialog_edit () {
      bus.$emit('oepn_dialog_address_edit', {
        address_id: this.current_address.id,
        form: {
          address_line1: this.current_address.address_line1,
          address_line2: this.current_address.address_line2,
          city: this.current_address.city,
          state: this.current_address.state,
          postal_code: this.current_address.postal_code,
          country: this.current_address.country,
          type: this.current_address.type
        }
      })
    },
    open_dialog_deletion () {
      bus.$emit('open_dialog_address_deletion', {
        address_id: this.current_address.id
      })
    }
  }
}
</script>