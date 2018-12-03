import './bootstrap.js'
import Vue from 'vue'
import App from './components/App'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'flag-icon-css/css/flag-icon.min.css'

import lodash from 'lodash'
// import axios from 'axios'
import axios from './helpers/axios'
import configData from './config'
import moment from 'moment'

import router from './router'
import store from './store/store'
import globalMixin from './mixin/global'

Vue.use(Vuetify)
Vue.use(VeeValidate)
Vue.mixin(globalMixin)

Vue.prototype.$config = configData
Vue.prototype.$moment = moment
Vue.prototype._ = lodash
Vue.prototype.$axios = axios


const app = new Vue({
  el: '#app',
  template: '<app></app>',
  components: { App },
  router,
  store
})
