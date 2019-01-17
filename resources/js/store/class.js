import Vue from 'vue'
import _ from 'lodash'
import axios from '../helpers/axios'

export default {
  namespaced: true,
  state: {
    class_groups: [],
    class_options: [],
    programs_taken: []
  },
  getters: {
    class_options (state) {
      return state.class_options
    },
    class_groups (state) {
      let original_data = _.clone(state.class_groups)
      let filtered_data_arr = []
      for(let i in original_data) {
        let filtered_itm = _.filter(original_data[i], {'deleted_at': null})
        if (!_.isEmpty(filtered_itm)) {
          filtered_data_arr.push(filtered_itm)
        }
      }

      return filtered_data_arr
    },
    programs_taken (state) {
      return state.programs_taken
    }
  },
  mutations: {
    set_class_options (state, options) {
      state.class_options = options
    },
    set_class_groups (state, groups) {
      state.class_groups = groups
    },
    set_programs_taken (state, programs) {
      state.programs_taken = programs
    },
    add_class_group (state, new_class) {
      state.class_groups.push([new_class])
    },
    edit_date (state, new_class) {
      state.class_groups.some(item => {
        return item.some((item2, index) => {
          if (item2.id === new_class.id) {
            Vue.set(item, index, new_class)
            return true
          }
        })
      })
    },
    chagne_class (state, payload) {
      state.class_groups.some(item => {
        return item.some((item2, index) => {
          if (item2.id === payload.original_class.id) {
            Vue.set(item, index, payload.original_class)
            item.push(payload.new_class)
            return true
          }
        })
      })
    },
    remove_class (state, removed_class) {
      state.class_groups.some(item => {
        return item.some((item2, index) => {
          if (item2.id === removed_class.id) {
            Vue.set(item, index, removed_class)
            return true
          }
        })
      })
    }
  },
  actions: {
    get_class_page (context, student_id) {
      axios.get(`/student/${student_id}/class`).then(res => {
        console.log('student classes', res)
        context.commit('set_programs_taken', res.data.programs_taken)
        context.commit('set_class_options', res.data.class_options)
        context.commit('set_class_groups', res.data.student_classes) 
      })
    },
    add_class (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/student/${payload.student_id}/class`, payload.form).then(res => {
          console.log('res s', res)
          context.commit('add_class_group', res.data)
          resolve()
        })  
      })
    },
    change_class (context, payload) {
      axios.post(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}/change_class`, {
        form: payload.form,
        group: payload.group
      }).then(res => {
        console.log('res', res)
        context.commit('chagne_class', {
          original_class: res.data.original_class,
          new_class: res.data.new_class
        })
      })
    },
    edit_date (context, payload) {
      return new Promise((resolve, reject) => {
        axios.post(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}/edit_date`, payload.form).then(res => {
          console.log('res', res)
          context.commit('edit_date', res.data)
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
        axios.delete(`/student/${payload.student_id}/class/pivot/${payload.pivot_id}`).then(res => {
          context.commit('remove_class', res.data)
          resolve()
        })
      })
    }
  }
}