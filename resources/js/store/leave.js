import Vue from 'vue'
import axios from '../helpers/axios'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    leave_types: [],
    leave_requests: [],
    programs_taken: [],
  },
  getters: {
    leave_types (state) {
      return state.leave_types
    },
    leave_requests (state) {
      return state.leave_requests
    },
    programs_taken (state) {
      return state.programs_taken
    },
    available_leave_requests (state) {
      let original_arr = _.clone(state.leave_requests)
      return _.filter(original_arr, function(value) {
        return value.administration.deleted_at === null
      })
    }
    // available_classes: (state) => (program) => {
    //   let original_arr = _.clone(program.classes)
    //   return _.filter(original_arr, function(value){
    //     return value.administration.deleted_at === null
    //   })
    // },
  },
  mutations: {
    set_leave_requests (state, value) {
      state.leave_requests = value
    },
    set_leave_types (state, value) {
      state.leave_types = value
    },
    set_programs_taken (state, value) {
      state.programs_taken = value
    },
    add_leave_request (state, value) {
      state.leave_requests.push(value)
    },
    update_leave_request (state, value) {
      state.leave_requests.some((request, i) => {
        if (request.id === value.id) {
          Vue.set(state.leave_requests, i, value)
          return true
        }
      })
    },
    // update_class (state, updated_class) {
    //   state.programs.some(program => {
    //     return program.classes.some((classinfo, index) => {
    //       if (classinfo.id === updated_class.id) {
    //         Vue.set(program.classes, index, updated_class)
    //         return true
    //       }
    //     })
    //   })
    // },
  },
  actions: {
    get_init (context, payload) {
      return new Promise((resolve, reject) => {
        axios.get(`student/${payload.student_id}/leave`).then(res => {
          console.log('res', res)
          context.commit('set_leave_types', res.data.leave_types)
          context.commit('set_leave_requests', res.data.leave_requests)
          context.commit('set_programs_taken', res.data.programs_taken)
          resolve()
        })
      })
    },
    store (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`leave`, payload.form).then(res => {
          console.log('res', res)
          context.commit('add_leave_request', res.data)
          resolve(res)
        })
      })
    },
    destroy (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`leave/${payload.leave_id}`).then(res => {
          console.log('res', res)
          context.commit('update_leave_request', res.data)
          resolve(res)
        })
      })
    },
    edit (context, payload) {
      return new Promise((resolve, reject) => {
        axios.put(`leave/${payload.leave_id}`, payload.form).then(res => {
          console.log('res', res)
          context.commit('update_leave_request', res.data)
          resolve(res)
        })
      })
    },
    update_programs_date (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`program/date`, payload.form).then(res => {
          console.log('res', res)
          resolve()
        })
      })
    }
  }
}