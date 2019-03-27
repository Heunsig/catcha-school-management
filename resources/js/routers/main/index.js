import Main from '../components/Main'


const routes = [
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
      // {
      //   path: 'student',
      //   component: Student,
      //   children: [
      //     {
      //       path:'',
      //       component: StudentList,
      //       name: 'student.list',
      //     },
      //     {
      //       path: 'register',
      //       component: StudentRegistration,
      //       name: 'student.registration'
      //     },
      //     {
      //       beforeEnter: (to, from, next) => {
      //         store.dispatch('student/get_min_info', {
      //           student_id: to.params.student_id
      //         }).then(res => {
      //           next()
      //         })
      //       },
      //       path: ':student_id',
      //       component: StudentDetailLayout,
      //       children: [
      //         {
      //           path: 'profile',
      //           component: StudentInformation,
      //           // name: 'student.',
      //           children: [
      //             {
      //               path: '',
      //               component: StudentBasicInformation,
      //               name: 'student.information.basic_information',
      //             },
      //             {
      //               path: 'contact',
      //               component: StudentContact,
      //               name: 'student.information.contact',
      //             },
      //             {
      //               path: 'address',
      //               component: StudentAddress,
      //               name: 'student.information.address',
      //             },
      //             {
      //               path: 'emergency_contact',
      //               component: StudentEmergencyContact,
      //               name: 'student.information.emergency_contact'
      //             }
      //           ]
      //         },
      //         {
      //           path: 'class',
      //           component: StudentProgramClass,
      //           name: 'student.class'
      //         },
      //         {
      //           path: 'invoice',
      //           component: StudentPayment,
      //           name: 'student.invoice'
      //         },
      //         {
      //           path: 'leave',
      //           component: StudentLeave,
      //           name: 'student.leave'
      //         },
      //         {
      //           path: 'document',
      //           component: StudentDocument,
      //           name: 'student.document'
      //         }
      //       ]
      //     }
      //   ]
      // },
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

export default routes