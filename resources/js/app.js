import './bootstrap.js'
import Vue from 'vue'
import App from './components/App'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import router from './router'
import store from './store/store'

Vue.use(Vuetify)

const app = new Vue({
  el: '#app',
  template: '<app></app>',
  components: { App },
  router,
  store
})
