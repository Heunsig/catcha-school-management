import './bootstrap.js'
import Vue from 'vue'
import App from './components/App'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import VueTheMask from 'vue-the-mask'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'flag-icon-css/css/flag-icon.min.css'

import lodash from 'lodash'
// import axios from 'axios'
import axios from './helpers/axios'
import configData from './config'
import moment from 'moment'
import account from 'accounting-js'

import router from './router'
import store from './store/store'
import globalMixin from './mixins/global'

import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-chalk/reset.css'

import { 
  Input, 
  InputNumber, 
  Select,
  Option,
  Cascader,
  Form, 
  FormItem,
  Table,
  TableColumn,
} from 'element-ui'

import CaFloatingBox from './components/ca-components/FloatingBox'

Vue.use(Vuetify)
Vue.use(VueTheMask)
Vue.use(VeeValidate, {fieldsBagName: 'vee-fields'})
Vue.mixin(globalMixin)

Vue.prototype.$config = configData
Vue.prototype.$moment = moment
Vue.prototype._ = lodash
Vue.prototype.$axios = axios
Vue.prototype.$account = account

locale.use(lang)
Vue.use(Input)
Vue.use(InputNumber)
Vue.use(Select)
Vue.use(Option)
Vue.use(Cascader)
Vue.use(Form)
Vue.use(FormItem)
Vue.use(Table)
Vue.use(TableColumn)

// Vue.component(CaFloatingBox)
Vue.component('ca-floating-box', CaFloatingBox)

const app = new Vue({
  el: '#app',
  template: '<app></app>',
  components: { App },
  router,
  store
})
