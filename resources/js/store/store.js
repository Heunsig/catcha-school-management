import Vue from 'vue'
import Vuex from 'vuex'
import axios from '../helpers/axios'

import studentModule from './student/index'
import classMoudle from './class/index'
// import invoiceModule from './invoice'
// import classModule from './student/class'
// import paymentModule from './payment'
import productModule from './product'
// import leaveModule from './leave'
import dashboardModule from './dashboard'
import accountMoudle from './account'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    student: studentModule,
    class: classMoudle,
    // test: {
    //   class: classModule
    // },
    // invoice: invoiceModule,
    // class: classModule,
    // payment: paymentModule,
    product: productModule,
    // leave: leaveModule,
    dashboard: dashboardModule,
    account: accountMoudle
  },
  state: {
    token: localStorage.getItem('access_token') || null,
    user: {}
    // user_email: '',
    // user_name: '',
  },
  getters: {
    loggedIn (state) {
      return state.token !== null
    },
    token (state) {
      return state.token
    },
    user (state) {
      return state.user
    },
    user_email (state) {
      return state.user.email
    },
    user_name (state) {
      return state.user.full_name
    }
  },
  mutations: {
    retrieveToken (state, token) {
      state.token = token
    },
    destroyToken (state) {
      state.token = null
    },
    setUser (state, user) {
      state.user = user
    }
  },
  actions: {
    // retrieveUser (context, payload) {
    //   axios.defaults.headers.common['Authorization'] = 'Bearer ' + payload.token

    //   return new Promise((resolve, reject) => {
    //     axios.get('/user').then(res => {
    //       context.commit('setUser', res.data)
    //       resolve()
    //     })
    //   })
    // },
    retrieveToken (context, credentials) {
      return new Promise((resolve, reject) => {
        axios.post('/login', {
          username: credentials.username,
          password: credentials.password
        }).then(res => {
          const token = res.data.access_token

          localStorage.setItem('access_token', token)
          context.commit('retrieveToken', token)
          resolve(token)
        })
      })
    },
    destroyToken (context) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

      if (context.getters.loggedIn) {
        return new Promise((resolve, reject) => {
          axios.post('/logout').then(res => {
            localStorage.removeItem('access_token')
            context.commit('destroyToken')
            resolve(res)
          }).catch((err) => {
            localStorage.removeItem('access_token')
            context.commit('destroyToken')
          })
        })
      }
    }
  }
})