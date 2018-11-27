import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store'

import LoginForm from './components/login/LoginForm'
import Main from './components/Main'
import StudentList from './components/app/student/StudentList'
import StudentRegistration from './components/app/student/StudentRegistration'

import StudentDetailLayout from './components/app/student/detail/StudentDetailLayout'
import StudentBasicInformation from './components/app/student/detail/StudentDetailBasicInformation'
import StudentClass from './components/app/student/detail/StudentDetailClass'
import StduentInvoice from './components/app/student/detail/StudentDetailInvoice'

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
          path:'student',
          component: StudentList,
          name: 'student.list',
        },
        {
          path: 'student/register',
          component: StudentRegistration,
          name: 'student.registration'
        },
        {
          path: 'student/:student_id',
          component: StudentDetailLayout,
          children: [
            {
              path: '',
              component: StudentBasicInformation,
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