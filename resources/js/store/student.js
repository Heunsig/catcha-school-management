import _ from 'lodash'
import axios from '../helpers/axios'

const student = {
  namespaced: true,
  state: {
    student_id: null,
    basic_information: {}
  },
  getters: {
    student_id (state) {
      return state.student_id
    },
    basic_information (state) {
      return state.basic_information
    },
  },
  mutations: {
    set_basic_information (state, payload) {
      state.basic_information = payload.basic_information
    },
    set_student_id (state, payload) {
      state.student_id = payload.student_id
    }
  },
  actions: {
    get_student (context, payload) {
      if (context.getters.student_id !== payload.student_id) {
        axios.get(`/student/${payload.student_id}/basic_information`).then(res => {
          console.log('get_student')
          context.commit('set_basic_information', {
            basic_information: res.data
          })

          context.commit('set_student_id', {
            student_id: payload.student_id
          })
        })
      }
    }
  }
}

export default student