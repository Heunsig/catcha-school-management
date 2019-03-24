import Vue from 'vue'
import axios from 'helpers/axios'

export default {
  namespaced: true,
  state: {
    classes: [],
    classinfo: {}
  },
  getters: {
    classes (state) {
      return state.classes
    },
    classinfo (state) {
      return state.classinfo
    },
    subjects (state) {
      return state.classinfo.subjects
    },
    students (state) {
      return state.classinfo.students
    },
    grade_groups (state) {
      return state.classinfo.grade_groups
    }
  },
  mutations: {
    set_classes (state, value) {
      state.classes = value 
    },
    set_classinfo (state, value) {
      state.classinfo = value
    }
  },
  actions: {
    get_classes (context, payload) {
      return new Promise((resolve, reject) => {
        axios.get(`class`).then(res => {
          console.log('res', res)
          context.commit('set_classes', res.data)
          resolve()
        })
      })
    },
    get_class (context, payload) {
      return new Promise((resolve, reject) => {
        axios.get(`class/${payload.classinfo_id}`).then(res => {
          console.log('res', res)
          // context.commit('set_classinfo', res.data)
          context.state.classinfo = res.data
          resolve()
        })
      })
    }
  }
}