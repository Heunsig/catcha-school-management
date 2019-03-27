import LoginForm from '../components/login/LoginForm'

const routes = [
    {
      path: '/login',
      component: LoginForm,
      name: 'login',
      meta: {
        requiresVisitor: true
      }
    }
]

export default routes