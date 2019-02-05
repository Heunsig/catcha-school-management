import _ from 'lodash'
import axios from '../helpers/axios'

const student = {
  namespaced: true,
  state: {
    student: {},
    current_address: {},
    home_address: {},
    cellphones: [],
    emergency_contact: {}
  },
  getters: {
    student (state) {
      return state.student
    },
    current_address (state) {
      return state.current_address
    },
    home_address (state) {
      return state.home_address
    },
    cellphones (state) {
      return state.cellphones
    },
    emergency_contact (state) {
      return state.emergency_contact
    }
  },
  mutations: {
    set_student (state, value) {
      state.student = value
    },
    set_current_address (state, value) {
      state.current_address = value
    },
    set_home_address (state, value) {
      state.home_address = value
    },
    set_cellphones (state, value) {
      state.cellphones = value      
    },
    set_emergency_contact (state, value) {
      state.emergency_contact = value
    },
    add_contact (state, value) {
      state.cellphones.push(value)
    },
    remove_contact (state, contact_id) {
      state.cellphones.some((cellphone, i) => {
        if (cellphone.id === contact_id) {
          state.cellphones.splice(i, 1)
          return true
        }
      })
    },
    delete_address (state, category) {
      console.log('cate', category)
      if (category === 'home') {
        state.home_address = []
      } else if (category === 'current') {
        state.current_address = []
      }
    }
  },
  actions: {
    get_student (context, payload) {
      return new Promise((resolve, reject) => {
        axios.get(`/student/${payload.student_id}`).then(res => {
          console.log('h', res)
          context.commit('set_student', res.data.student)
          context.commit('set_current_address', res.data.current_address)
          context.commit('set_home_address', res.data.home_address)
          context.commit('set_cellphones', res.data.contacts)
          context.commit('set_emergency_contact', res.data.emergency_contact)
          resolve(res.data)
        })
      })
    },
    store_contact (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/contact`, payload.form).then(res => {
          console.log('res', res)
          context.commit('add_contact', res.data)
          resolve()
        })
      })
    },
    remove_contact (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`/contact/${payload.contact_id}`).then(res => {
          console.log('res', res)
          context.commit('remove_contact', payload.contact_id)
          resolve()
        })
      })
    },
    store_emergency_contact (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/emergency_contact`, payload.form).then(res => {
          console.log('res', res)
          resolve()
        })
      })
    },
    update_emergency_contact (context, payload) {
      return new Promise((resolve, reject) => {
        axios.put(`/emergency_contact/${payload.emergency_contact_id}`, payload.form).then(res => {
          console.log('res', res)
          context.commit('set_emergency_contact', res.data)
          resolve()
        })
      })
    },
    store_address (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/address`, payload.form).then(res => {
          console.log('res', res)
          if (res.data.category === 'home') {
            context.commit('set_home_address', res.data)
          } else if (res.data.category === 'current') {
            context.commit('set_current_address', res.data)
          }

          resolve()
        })
      })
    },
    update_address (context, payload) {
      // console.log('py', payload)
      return new Promise((resolve, reject) => {
        axios.put(`/address/${payload.address_id}`, payload.form).then(res => {
          console.log('res', res)
          if (res.data.category === 'home') {
            context.commit('set_home_address', res.data)
          } else if (res.data.category === 'current') {
            context.commit('set_current_address', res.data)
          }
          resolve()
        })
      })
    },
    delete_address (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`/address/${payload.address_id}`).then(res => {
          console.log('res', res)
          context.commit('delete_address', res.data.category)
          resolve()
        })
      })
    }
  }
}

export default student