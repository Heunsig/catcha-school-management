import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store'

import LoginForm from './components/login/LoginForm'
import Main from './components/Main'

import Dashboard from './components/app/dashboard/Dashboard'

import Student from './components/app/student/Index'
import StudentList from './components/app/student/StudentList'
import StudentRegistration from './components/app/student/StudentRegistration'

import StudentDetailLayout from './components/app/student/detail/Layout'
import StudentInformation from './components/app/student/detail/student_information/Index'
import StudentClass from './components/app/student/detail/Class'
import StduentInvoice from './components/app/student/detail/Invoice'
import StudentLeave from './components/app/student/detail/leave/Index'

Vue.use(VueRouter)

const router = new VueRouter({
  routes: [
    {
      path: '/login',
      component: LoginForm,
      name: 'login',
      meta: {
        requiresVisitor: true
      }
    },
    {
      path: '/',
      component: Main,
      name: 'main',
      meta: {
        requiresAuth: true
      },
      children: [
        {
          path: 'dashboard',
          component: Dashboard,
          name: 'dashboard'
        },
        {
          path: 'student',
          component: Student,
          children: [
            {
              path:'',
              component: StudentList,
              name: 'student.list',
            },
            {
              path: 'register',
              component: StudentRegistration,
              name: 'student.registration'
            },
            {
              path: ':student_id',
              component: StudentDetailLayout,
              children: [
                {
                  path: '',
                  component: StudentInformation,
                  name: 'student.basic_information'
                },
                {
                  path: 'class',
                  component: StudentClass,
                  name: 'student.class'
                },
                {
                  path: 'invoice',
                  component: StduentInvoice,
                  name: 'student.invoice'
                },
                {
                  path: 'leave',
                  component: StudentLeave,
                  name: 'student.leave'
                }
              ]
            }
          ]
        }
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.loggedIn) {
      next({
        name: 'login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (store.getters.loggedIn) {
      next({ name: 'main' })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router