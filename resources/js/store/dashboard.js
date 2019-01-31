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
    }
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
    finishing_programs (state, value) {
      return state.finishing_programs
    },
    coming_leaves (state, value) {
      return state.coming_leaves
    },
    finishing_leaves (state, value) {
      return state.finishing_leaves
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
    }
  }
}