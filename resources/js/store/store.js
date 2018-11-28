import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: localStorage.getItem('access_token') || null
  },
  getters: {
    loggedIn (state) {
      return state.token !== null
    },
    token (state) {
      return state.token
    }
  },
  mutations: {
    retrieveToken (state, token) {
      state.token = token
    },
    destroyToken (state) {
      state.token = null
    }
  },
  actions: {
    retrieveToken (context, credentials) {
      return new Promise((resolve, reject) => {
        axios.post('/login', {
          username: credentials.username,
          password: credentials.password
        }).then(res => {
          const token = res.data.access_token

          localStorage.setItem('access_token', token)
          context.commit('retrieveToken', token)
          resolve(res)
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