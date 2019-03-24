import Vue from 'vue'
import _ from 'lodash'
import axios from 'helpers/axios'

const CancelToken = axios.CancelToken;
const source = CancelToken.source();

export default {
  namespaced: true,
  state: {
    programs: [],
    class_selection_options: [],
    program_selection_options: []
  },
  getters: {
    class_selection_options (state) {
      return state.class_selection_options
    },
    programs (state) {
      return state.programs
    },
    available_classes: (state) => (program) => {
      let original_arr = _.clone(program.classes)
      return _.filter(original_arr, function(value){
        return value.administration.deleted_at === null
      })
    },
    program_selection_options (state) {
      return state.program_selection_options
    },
  },
  mutations: {
    set_class_selection_options (state, options) {
      state.class_selection_options = options
    },
    set_program_selection_options (state, options) {
      state.program_selection_options = options
    },
    set_programs (state, programs) {
      state.programs = programs
    },
    add_program (state, new_program) {
      state.programs.push(new_program)
    },
    add_class (state, payload) {
      let program = _.find(state.programs, {'id': payload.program_id})
      program.classes.push(payload.new_class)
    },
    chagne_class (state, payload) {
      let program = _.find(state.programs, {id: payload.program_id})
      program.classes.some((classinfo, index) => {
        if (classinfo.id === payload.original_class.id) {
          Vue.set(program.classes, index, payload.original_class)
          program.classes.push(payload.new_class)
          return true
        }
      })
    },
    update_class (state, updated_class) {
      state.programs.some(program => {
        return program.classes.some((classinfo, index) => {
          if (classinfo.id === updated_class.id) {
            Vue.set(program.classes, index, updated_class)
            return true
          }
        })
      })
    },
    update_program (state, updated_program) {
      state.programs.some((program, index) => {
        if (program.id === updated_program.id) {
          Vue.set(state.programs, index, updated_program)
          return true 
        }
      })
    },
    remove_program_term (state, payload) {
      state.programs.some((program, index) => {
        if (program.id === payload.program_id) {
          program.dates.some((date, i) => {
            if (date.id === payload.date_id) {
              program.dates.splice(i, 1);
            }
          })
        }
      })
    }
  },
  actions: {
    get_class_page (context, student_id) {
      return new Promise((resolve, reject) => {
        axios.get(`/student/${student_id}/class`).then(res => {
          console.log('student classes', res)

          context.commit('set_programs', res.data.programs)
          context.commit('set_class_selection_options', res.data.class_selection_options)
          context.commit('set_program_selection_options', res.data.program_selection_options)
          resolve()
        })
      })
    },
    add_program (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/program`, payload.form).then(res => {
          console.log('program', res)
          context.commit('add_program', res.data)
          resolve()
        })
      })
    },
    reset_program (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/program/${payload.program_id}/reset`).then(res => {
          context.commit('update_program', res.data)
          resolve()
        })
      })
    },
    delete_program (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`/program/${payload.program_id}`).then(res => {
          console.log('result', res)
          context.commit('update_program', res.data)
          resolve()
        })
      })
    },
    add_class (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/program/class`, payload.form).then(res => {
          console.log('res s', res)
          context.commit('add_class', {
            program_id: payload.form.program_id,
            new_class: res.data
          })
          resolve()
        })  
      })
    },
    change_class (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/program/class/${payload.class_in_program_id}`, payload.form).then(res => {
          console.log('result', res)
          context.commit('chagne_class', {
            program_id: payload.form.program_id,
            original_class: res.data.original_class,
            new_class: res.data.new_class
          })
          resolve()
        })
      })
    },
    edit_date (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`class_in_program/${payload.class_in_program_id}/edit/date`, payload.form).then(res => {
          console.log('res', res)
          context.commit('update_class', res.data)
          resolve()
        })
      })
    },
    del_class (context, payload) {
      // 
      // Need to modify because if a client uses filtered mode, classes which are deleted should
      // be deleted. However, if a client uses non-filtered mode, classes which are deleted should
      // be shown up on the page.
      // 
      return new Promise((resolve, reject) => {
        axios.delete(`/program/class/${payload.class_in_program_id}`).then(res => {
          console.log('res', res)
          context.commit('update_class', res.data)
          resolve()
        })
      })
    },
    complete_class (context, payload) {
      return new Promise((resolve, reject) => {
        console.log('pay', payload)
        axios.post(`class_in_program/${payload.class_in_program_id}/complete`, payload.form).then(res => {
          console.log('res', res)
          context.commit('update_class', res.data)
          resolve()
        })
      })
    },
    update_program_term (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/program/${payload.program_id}/date`, payload.form).then(res => {
          console.log('res', res)
          context.commit('update_program', res.data)
          resolve()
        })
      })
    },
    destroy_program_term (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`/program/${payload.program_id}/date/${payload.date_id}`).then(res => {
          console.log('res', res)
          context.commit('remove_program_term', {
            program_id: payload.program_id,
            date_id: payload.date_id
          })
          resolve()
        })
      })
    }
  }
}