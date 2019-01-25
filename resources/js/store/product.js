import axios from '../helpers/axios'
import _ from 'lodash'

export default {
  namespaced: true,
  state: {
    products: []
  },
  getters: {
    products (state) {
      return state.products
    }
  },
  mutations: {
    set_products (state, value) {
      state.products = value
    }
  },
  actions: {
    get_products (context, payload) {
      axios.get('/product').then(res => {
        context.commit('set_products', res.data)
      })
    }
  }
}