import _ from 'lodash'
import axios from '../helpers/axios'

const student = {
  namespaced: true,
  state: {
    user: {}
  },
  getters: {
    user (state) {
      return state.user
    }
  },
  mutations: {
    set_user (state, user) {
      state.user = user
    }
  },
  actions: {
    retrieve_user (context, payload) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + payload.token

      return new Promise((resolve, reject) => {
        axios.get('/user').then(res => {
          context.commit('set_user', res.data)
          resolve()
        })
      })
    },
    update_profile (context, payload) {
      return new Promise((resolve, reject) => {
        axios.put(`user`, payload.form).then(res => {
          console.log('res', res)
          context.commit('set_user', res.data)
          resolve()
        })
      })
    },
    change_password (context, payload) {
      return new Promise((resolve, reject) => {
        axios.patch(`user/password`, payload.form).then(res => {
          console.log('res', res)
          resolve()
        }).catch(err => {
          reject()
        })
      })
    }
  }
}

export default student