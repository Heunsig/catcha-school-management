import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store'

import LoginForm from './components/login/LoginForm'
import Main from './components/Main'
import StudentList from './components/app/student/StudentList'
import StudentRegistration from './components/app/student/StudentRegistration'
import StudentDetail from './components/app/student/StudentDetail'

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
          component: StudentDetail,
          name: 'student.detail'
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