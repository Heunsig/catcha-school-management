import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store'

import LoginForm from './components/login/LoginForm'
import Main from './components/Main'

import Dashboard from './components/app/dashboard/Index'

import Student from './components/app/student/Index'
import StudentList from './components/app/student/StudentList'
import StudentRegistration from './components/app/student/StudentRegistration'

import StudentDetailLayout from './components/app/student/detail/Layout'
import StudentInformation from './components/app/student/detail/student_information/Index'
import StudentBasicInformation from './components/app/student/detail/student_information/basic_information/Index'
import StudentContact from './components/app/student/detail/student_information/contact/Index'
import StudentAddress from './components/app/student/detail/student_information/address/Index'
import StudentEmergencyContact from './components/app/student/detail/student_information/emergency_contact/Index'
import StudentProgramClass from './components/app/student/detail/program_and_class/Index'
// import StudentPayment from './components/app/student/detail/Payment'
import StudentPayment from './components/app/student/detail/payment/Index'
import StudentLeave from './components/app/student/detail/leave/Index'
import StudentDocument from './components/app/student/detail/document/Index'

import Class from './components/app/class/Index'
import ClassList from './components/app/class/ClassList'
import ClassDetailLayout from './components/app/class/detail/Layout'
import ClassStudent from './components/app/class/detail/student/Index'
import ClassGrade from './components/app/class/detail/grade/Index'
import ClassReport from './components/app/class/detail/report/Index'
import ClassReportStudent from './components/app/class/detail/report/student/Index'

import Account from './components/app/account/Index'
import AccountProfile from './components/app/account/profile/Index'
import AccountSecurity from './components/app/account/security/Index'

import Setting from './components/app/setting/Index'

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
      beforeEnter: (to, from, next) => {
        store.dispatch('account/retrieve_user', {
          token: store.getters['token']
        }).then((res) => {
          console.log('got user info')
          next()
        })
      },
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
              beforeEnter: (to, from, next) => {
                store.dispatch('student/get_min_info', {
                  student_id: to.params.student_id
                }).then(res => {
                  next()
                })
              },
              path: ':student_id',
              component: StudentDetailLayout,
              children: [
                {
                  path: 'profile',
                  component: StudentInformation,
                  // name: 'student.',
                  children: [
                    {
                      path: '',
                      component: StudentBasicInformation,
                      name: 'student.information.basic_information',
                    },
                    {
                      path: 'contact',
                      component: StudentContact,
                      name: 'student.information.contact',
                    },
                    {
                      path: 'address',
                      component: StudentAddress,
                      name: 'student.information.address',
                    },
                    {
                      path: 'emergency_contact',
                      component: StudentEmergencyContact,
                      name: 'student.information.emergency_contact'
                    }
                  ]
                },
                {
                  path: 'class',
                  component: StudentProgramClass,
                  name: 'student.class'
                },
                {
                  path: 'invoice',
                  component: StudentPayment,
                  name: 'student.invoice'
                },
                {
                  path: 'leave',
                  component: StudentLeave,
                  name: 'student.leave'
                },
                {
                  path: 'document',
                  component: StudentDocument,
                  name: 'student.document'
                }
              ]
            }
          ]
        },
        {
          path: 'account',
          component: Account,
          name: 'account',
          children: [
            {
              path: 'profile',
              component: AccountProfile,
              name: 'account.profile'
            },
            {
              path: 'security',
              component: AccountSecurity,
              name: 'account.security'
            }
          ]
        },
        {
          path: 'class',
          component: Class,
          children: [
            {
              path: '',
              component: ClassList,
              name: 'class.list'              
            },
            {
              beforeEnter: (to, from, next) => {
                store.dispatch('class/get_class', {
                  classinfo_id: to.params.classinfo_id
                }).then(res => {
                  next()
                })
              },
              path: ':classinfo_id',
              component: ClassDetailLayout,
              children: [
                {
                  path: 'student',
                  component: ClassStudent,
                  name: 'class.student'
                },
                {
                  path: 'grade/subject/:subject_id/date/:date',
                  component: ClassGrade,
                  name: 'class.grade'
                },
                {
                  path: 'report',
                  component: ClassReport,
                  name: 'class.report',
                  children: [
                    {
                      path: 'groupby/student',
                      component: ClassReportStudent,
                      name: 'class.report.student'
                    }
                  ]
                }
              ]
            }
          ]
        },
        {
          path: 'setting',
          component: Setting,
          name: 'setting'
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
      next({ name: 'dashboard' })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router