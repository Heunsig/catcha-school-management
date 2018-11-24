import Vue from 'vue'
import VueRouter from 'vue-router'

import LoginForm from './components/login/LoginForm'
import Main from './components/Main'

Vue.use(VueRouter)

const router = new VueRouter({
  routes: [
    {
      path: '/login',
      component: LoginForm,
      name: 'login'
    },
    {
      path: '/',
      component: Main,
      name: 'main'
    }
  ]
})

export default router