<template>
  <v-card>
    <v-card-title>
      <div class="ca-typo-title-3">Basic Information</div>
      <v-spacer></v-spacer>
      <!-- <v-btn icon @click="open_dialog_add()">
        <v-icon>add</v-icon>
      </v-btn> -->
      <v-btn icon @click="open_dialog_edit()">
        <v-icon small color="grey darken-1">edit</v-icon>
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-container fluid class="pa-0 ca-grid-list-2">
        <v-layout wrap>
          <v-flex xs6>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Type</div>
              <div class="ca-label-content" v-if="student.type.name">{{ student.type.name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs6>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Status</div>
              <div class="ca-label-content" v-if="student.status.name">{{ student.status.name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">First Name</div>
              <div class="ca-label-content" v-if="student.first_name">{{ student.first_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Middle Name</div>
              <div class="ca-label-content" v-if="student.middle_name">{{ student.middle_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Last Name</div>
              <div class="ca-label-content" v-if="student.last_name">{{ student.last_name }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs3>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Nickname</div>
              <div class="ca-label-content" v-if="student.nickname">{{ student.nickname }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Email</div>
              <div class="ca-label-content" v-if="student.email">{{ student.email }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Sex</div>
              <div class="ca-label-content" v-if="student.sex">{{ student.sex }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label">
              <div class="ca-label-title ca-title-5 font-weight-bold">Date of Birth</div>
              <div class="ca-label-content" v-if="student.date_of_birth">{{ $moment(student.date_of_birth).format('MM/DD/Y') }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Country of Citizenship</div>
            <div class="ca-label-content" v-if="student.country_of_citizenship">
              <span class="flag-icon mr-1" :class="get_flag(get_country(student.country_of_citizenship).code)"></span>
              {{ get_country(student.country_of_citizenship).name }}
            </div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Country of Birth</div>
            <div class="ca-label-content" v-if="student.country_of_birth">
              <span class="flag-icon mr-1" :class="get_flag(get_country(student.country_of_citizenship).code)"></span>
              {{ get_country(student.country_of_birth).name }}
            </div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs4>
            <div class="ca-label-title ca-title-5 font-weight-bold">Cith of Birth</div>
            <div class="ca-label-content" v-if="student.city_of_birth">{{ student.city_of_birth }}</div>
            <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
          </v-flex>
          <v-flex xs12>
            <div class="ca-label ca-label-wrap">
              <div class="ca-label-title ca-title-5 font-weight-bold">Note</div>
              <div class="ca-label-content" v-if="student.note">{{ student.note }}</div>
              <div class="ca-label-content ca-typo-style-blank" v-else>No Info</div>
            </div>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
    <!-- <BasicInformationAdditionDialog></BasicInformationAdditionDialog> -->
    <BasicInformationEditDialog></BasicInformationEditDialog>
  </v-card>
</template>
<script>
import bus from 'bus'
import countriesMixin from '../../../../../../mixins/countries'
// import BasicInformationAdditionDialog from './BasicInformationAdditionDialog'
import BasicInformationEditDialog from './BasicInformationEditDialog'

export default {
  mixins: [
    countriesMixin
  ],
  components: {
    // BasicInformationAdditionDialog,
    BasicInformationEditDialog
  },
  computed: {
    student () {
      return this.$store.getters['student/student']
    }
  },
  methods: {
    get_flag (code) {
      return code ? 'flag-icon-' + code.toLowerCase():null
    },
    // open_dialog_add () {
    //   console.log('hid')
    //   bus.$emit('open_dialog_basic_information_addition')
    // },
    open_dialog_edit () {
      bus.$emit('open_dialog_basic_information_edit', {
        form: {
          type_id: this.student.type.id,
          status_id: this.student.status.id,
          email: this.student.email,
          first_name: this.student.first_name,
          middle_name: this.student.middle_name,
          last_name: this.student.last_name,
          nickname: this.student.nickname,
          date_of_birth: this.student.date_of_birth,
          country_of_birth: this.student.country_of_birth,
          city_of_birth: this.student.city_of_birth,
          country_of_citizenship: this.student.country_of_citizenship,
          sex: this.student.sex,
          note: this.student.note
        }
      })
    }
  }
}
</script>