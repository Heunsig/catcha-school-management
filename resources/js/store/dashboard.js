import Vue from 'vue'
import axios from '../helpers/axios'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    // added_students: [],
    current_studying_students: 0,
    new_students: {},
    coming_programs: {},
    finishing_programs: {},
    coming_leaves: {},
    finishing_leaves: {},
    leaves_today: {},
    full_new_students: [],
    full_coming_programs: [],
    full_finishing_programs: [],
    full_coming_leaves: [],
    full_finishing_leaves: [],
    full_leaves_today: []
  },
  getters: {
    current_studying_students (state) {
      return state.current_studying_students
    },
    new_students (state) {
      return state.new_students
    },
    coming_programs (state) {
      return state.coming_programs
    },
    finishing_programs (state) {
      return state.finishing_programs
    },
    coming_leaves (state) {
      return state.coming_leaves
    },
    finishing_leaves (state) {
      return state.finishing_leaves
    },
    leaves_today (state) {
      return state.leaves_today
    },
    full_new_students (state) {
      return state.full_new_students
    },
    full_coming_programs (state) {
      return state.full_coming_programs
    },
    full_finishing_programs (state) {
      return state.full_finishing_programs
    },
    full_coming_leaves (state) {
      return state.full_coming_leaves
    },
    full_finishing_leaves (state) {
      return state.full_finishing_leaves
    },
    full_leaves_today (state) {
      return state.full_leaves_today
    }
  },
  mutations: {
    set_current_studying_students (state, value) {
      // state.current_studying_students = parseInt(value)
      state.current_studying_students = value
    },
    set_new_student (state, value) {
      state.new_students = value
    },
    set_coming_programs (state, value) {
      state.coming_programs = value
    },
    set_finishing_programs (state, value) {
      state.finishing_programs = value
    },
    set_coming_leaves (state, value) {
      state.coming_leaves = value
    },
    set_finishing_leaves (state, value) {
      state.finishing_leaves = value
    },
    set_leaves_today (state, value) {
      state.leaves_today = value
    },
    set_full_new_students (state, value) {
      state.full_new_students = value
    },
    set_full_coming_programs (state, value) {
      state.full_coming_programs = value
    },
    set_full_finishing_programs (state, value) {
      state.full_finishing_programs = value
    },
    set_full_coming_leaves (state, value) {
      state.full_coming_leaves = value
    },
    set_full_finishing_leaves (state, value) {
      state.full_finishing_leaves = value
    },
    set_full_leaves_today (state, value) {
      state.full_leaves_today = value
    }
  },
  actions: {
    get_init (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard').then(res => {
          console.log('res', res)
          context.commit('set_current_studying_students', res.data.current_studying_students)
          context.commit('set_new_student', res.data.new_students)
          context.commit('set_coming_programs', res.data.coming_programs)
          context.commit('set_finishing_programs', res.data.finishing_programs)
          context.commit('set_coming_leaves', res.data.coming_leaves)
          context.commit('set_finishing_leaves', res.data.finishing_leaves)
          context.commit('set_leaves_today', res.data.leaves_today)
          resolve()
        }).catch(err => {
          console.log('Reject!!!')
          reject()
        })
      })
    },
    get_full_coming_programs (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/coming_programs').then(res => {
          console.log('res', res)
          context.commit('set_full_coming_programs', res.data)
          resolve()
        })
      })
    },
    get_full_finishing_programs (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/finishing_programs').then(res => {
          context.commit('set_full_finishing_programs', res.data)
          resolve()
        })
      })
    },
    get_full_coming_leaves (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/coming_leaves').then(res => {
          context.commit('set_full_coming_leaves', res.data)
          resolve()
        })
      })
    },
    get_full_finishing_leaves (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/finishing_leaves').then(res => {
          context.commit('set_full_finishing_leaves', res.data)
          resolve()
        })
      })
    },
    get_full_new_students (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/new_students').then(res => {
          console.log('full_n_s', res)
          context.commit('set_full_new_students', res.data)
          resolve()
        })
      })
    },
    get_full_leaves_today (context, payload) {
      new Promise((resolve, reject) => {
        axios.get('dashboard/leaves_today').then(res => {
          context.commit('set_full_leaves_today', res.data)
          resolve()
        })
      })
    }
  }
}