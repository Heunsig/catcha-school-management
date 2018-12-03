// import lodash from 'lodash'
// import axios from 'axios'
// import configData from './config'
// import moment from 'moment'

// window.config = configData
// window.moment = moment
// window.lodash = lodash
// window.axios = axios
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
// window.axios.defaults.baseURL = config.AXIOS_BASE_URL
// window.axios.interceptors.response.use(null, function (error) {
//     if (error.response) {
//       console.log(error.response.data)
//       console.log(error.response.status)
//       console.log(error.response.headers)
//     } else if (error.request) {
//       console.log(error.request)
//     } else {
//       console.log('Error', error.message)
//     }
//     console.log(error.config)
//     return Promise.reject(error)
// });
// 
import axios from './helpers/axios'


let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}
