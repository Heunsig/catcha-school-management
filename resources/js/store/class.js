import Vue from 'vue'
import _ from 'lodash'
import axios from '../helpers/axios'

const CancelToken = axios.CancelToken;
const source = CancelToken.source();

export default {
  namespaced: true,
  state: {
    // class_groups: [],
    programs: [],
    class_selection_options: [],
    // programs_taken: [],
    program_selection_options: []
  },
  getters: {
    class_selection_options (state) {
      return state.class_selection_options
    },
    programs (state) {
      return state.programs
    },
  //   getTodoById: (state) => (id) => {
  //   return state.todos.find(todo => todo.id === id)
  // }
    available_classes: (state) => (program) => {
      let original_arr = _.clone(program.classes)
      return _.filter(original_arr, function(value){
        return value.administration.deleted_at === null
      })
    },
    // class_groups (state) {
    //   let original_data = _.clone(state.class_groups)
    //   let filtered_data_arr = []
    //   for(let i in original_data) {
    //     let filtered_itm = _.filter(original_data[i], {'deleted_at': null})
    //     if (!_.isEmpty(filtered_itm)) {
    //       filtered_data_arr.push(filtered_itm)
    //     }
    //   }

    //   return filtered_data_arr
    // },
    program_selection_options (state) {
      return state.program_selection_options
    },
    // programs_taken (state) {
    //   return state.programs_taken
    // }
  },
  mutations: {
    set_class_selection_options (state, options) {
      state.class_selection_options = options
    },
    // set_class_groups (state, groups) {
    //   state.class_groups = groups
    // },
    // set_programs_taken (state, programs) {
    //   state.programs_taken = programs
    // },
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
    // edit_date (state, edited_class) {
    //   state.programs.some(program => {
    //     return program.classes.some((class_item, index) => {
    //       if (class_item.id === edited_class.id) {
    //         Vue.set(program.classes, index, edited_class)
    //         return true
    //       }
    //     })
    //   })
    //   // state.class_groups.some(item => {
    //   //   return item.some((item2, index) => {
    //   //     if (item2.id === new_class.id) {
    //   //       Vue.set(item, index, new_class)
    //   //       return true
    //   //     }
    //   //   })
    //   // })
    // },
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
    // remove_program (state, removed_program) {
    //   state.programs.some((program, index) => {
    //     if (program.id === removed_program.id) {
    //       Vue.set(state.programs, index, removed_program)
    //       return true
    //     }
    //   })
    // },
    update_program (state, updated_program) {
      state.programs.some((program, index) => {
        if (program.id === updated_program.id) {
          Vue.set(state.programs, index, updated_program)
          return true 
        }
      })
    }
  },
  actions: {
    get_class_page (context, student_id) {
      axios.get(`/student/${student_id}/class`).then(res => {
        console.log('student classes', res)

        // context.commit('set_programs_taken', res.data.programs_taken)
        context.commit('set_programs', res.data.programs)
        context.commit('set_class_selection_options', res.data.class_selection_options)
        context.commit('set_program_selection_options', res.data.program_selection_options)
        // context.commit('set_class_groups', res.data.student_classes) 
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
    delete_program (context, payload) {
      return new Promise((resolve, reject) => {
        axios.delete(`/program/${payload.program_id}`).then(res => {
          console.log('result', res)
          // context.commit('remove_program', res.data)
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
      // axios.post(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}/change_class`, {
      //   form: payload.form,
      //   group: payload.group
      // }).then(res => {
      //   console.log('res', res)
      //   context.commit('chagne_class', {
      //     original_class: res.data.original_class,
      //     new_class: res.data.new_class
      //   })
      // })
    },
    edit_date (context, payload) {
      return new Promise((resolve, reject) => {
        // axios.post(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}/edit_date`, payload.form).then(res => {
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
        // axios.delete(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}`).then(res => {
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
    }
  }
}