const router = [
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
]

export default router