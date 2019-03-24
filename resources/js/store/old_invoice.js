import axios from '../helpers/axios'
import moment from 'moment'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    // status: '',
    // note: '',
    // payment_date: '',
    // payment_method: {
    //   key: null,
    //   detail: null
    // },
    // invoice_items: []
  },
  getters: {
    // invoice (state) {
    //   return state
    // },
    // payment_method (state) {
    //   return state.payment_method
    // },
    // invoice_items (state) {
    //   return state.invoice_items
    // },
    // total (state) {
    //   let result = 0

    //   for (let i in state.invoice_items) {
    //     if (state.invoice_items[i].price) {
    //       result += parseInt(state.invoice_items[i].price)  
    //     }
    //   }

    //   console.log(typeof result, result)
    //   return result
    // }
  },
  mutations: {
    // set_status (state, payload) {
    //   state.status = payload.status
    // },
    // set_note (state, payload) {
    //   state.note = payload.note
    // },
    // set_payment_method_key (state, payload) {
    //   state.payment_method.key = payload.payment_method_key
    // },
    // set_payment_method_detail (state, payload) {
    //   state.payment_method.detail = payload
    // },
    // add_new_invoice (state, payload) {
    //   let item_form = {
    //     product_id: [],
    //     start_date: '',
    //     completion_date: '',
    //     price: '',
    //     quantity: '',
    //     note: ''
    //   }
    //   state.invoice_items.push(item_form)
    // },
  },
  actions: {
    // add_invoice (context, payload) {
    //   return new Promise((resolve, reject) => {
    //     axios.post(`/invoice`, {
    //       student_id: payload.student_id,
    //       status: context.state.status,
    //       note: context.state.note,
    //       payment_method: {
    //         key: context.state.payment_method.key
    //       },
    //       invoice_items: context.state.invoice_items
    //     }).then(res => {
    //       // console.log('res', res)
    //       resolve(res.data)
    //     })
    //   })
    // },
    // change_status (context, payload) {
    //   let id = payload.invoice_id
    //   return new Promise((resolve, reject) => {
    //     axios.post(`/invoice/${id}/change_status`, {
    //       status: payload.status
    //     }).then(res => {
    //       // console.log('res', res)
    //       resolve(res.data)
    //     })
    //   })

    //   // return new Promise((resolve, reject) => {
    //   //     axios.post('/logout').then(res => {
    //   //       localStorage.removeItem('access_token')
    //   //       context.commit('destroyToken')
    //   //       resolve(res)
    //   //     }).catch((err) => {
    //   //       localStorage.removeItem('access_token')
    //   //       context.commit('destroyToken')
    //   //     })
    //   //   })
    // },
    // del_invoice (context, payload) {
    //   let id = payload.invoice_id
    //   return new Promise((resolve, reject) => {
    //     axios.delete(`/invoice/${id}`).then(res => {
    //       console.log('res', res)
    //       resolve(res.data)
    //     })
    //   })
    // },
    // refund_invoice (context, payload) {
    //   let id = payload.invoice.id
    //   // console.log('id', payload)
    //   console.log('pay', payload)
    //   return new Promise((resolve, reject) => {
    //     axios.post(`/invoice/${id}/refund`,{
    //       invoice: payload.invoice,
    //       student_id: payload.student_id,
    //       refunded_product_ids: payload.refunded_product_ids
    //     }).then(res => {
    //       console.log('res', res)
    //     })
    //   })
    // },
    // remove_invoice_item (context, item) {
    //   console.log('remove_invoice_item')
    //   // let index = context.state.invoice_items.indexOf(item)
    //   // context.state.invoice_items.splice(index, 1)
    // }
  }
}