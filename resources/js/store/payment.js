import Vue from 'vue'
import axios from '../helpers/axios'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    payments: [],
    payment_methods: []
  },
  getters: {
    payment_methods (state) {
      return state.payment_methods
    },
    payments (state) {
      return state.payments
    }
  },
  mutations: {
    set_payments (state, value) {
      state.payments = value
    },
    set_payment_methods (state, value) {
      state.payment_methods = value
    },
    update_payment (state, value) {
      state.payments.some((payment, i) => {
        if (payment.id === value.id) {
          Vue.set(state.payments, i, value)
          return true
        }
      })
    }
  },
  actions: {
    init_data (context, payload) {
      axios.get(`/student/${payload.student_id}/payment`).then(res => {
        console.log('res', res)
        context.commit('set_payments', res.data.payments)
        context.commit('set_payment_methods', res.data.payment_methods)
      })
    },
    store (context, payload) {
      console.log('payload', payload)
      new Promise((resolve, reject) => {
        axios.post(`/payment`, payload.form).then(res => {
          console.log('res', res)
          resolve()
        })
      })
    },
    destory (context, payload) {
      new Promise((resolve, reject) => {
        axios.delete(`/payment/${payload.payment_id}`).then(res => {
          console.log('destroy', res)
          context.commit('update_payment', res.data)
          resolve()
        })
      })
    },
    change_status (context, payload) {
      new Promise((resolve, reject) => {
        axios.post(`/payment/${payload.payment_id}/change_status`, payload.form).then(res => {
          console.log('chage status', res)
          context.commit('update_payment', res.data)
          resolve()
        })
      })
    }
  }
}
