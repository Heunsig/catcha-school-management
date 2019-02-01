import Vue from 'vue'
import axios from '../helpers/axios'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    // added_students: [],
    current_studying_students: 0,
    new_students: {
      items: [],
      count: null
    },
    coming_programs: {
      items: [],
      count: null
    },
    finishing_programs: {
      items: [],
      count: null
    },
    coming_leaves: {
      items: [],
      count: null
    },
    finishing_leaves: {
      items: [],
      count: null
    },
    full_new_students: [],
    full_coming_programs: [],
    full_finishing_programs: [],
    full_coming_leaves: [],
    full_finishing_leaves: []
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
    }
  },
  mutations: {
    set_current_studying_students (state, value) {
      state.current_studying_students = parseInt(value)
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
    }
  },
  actions: {
    get_init (context, payload) {
      axios.get('dashboard').then(res => {
        console.log('res', res)
        context.commit('set_current_studying_students', res.data.current_studying_students)
        context.commit('set_new_student', res.data.new_students)
        context.commit('set_coming_programs', res.data.coming_programs)
        context.commit('set_finishing_programs', res.data.finishing_programs)
        context.commit('set_coming_leaves', res.data.coming_leaves)
        context.commit('set_finishing_leaves', res.data.finishing_leaves)
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
          context.commit('set_full_new_students', res.data)
          resolve()
        })
      })
    }
  }
}