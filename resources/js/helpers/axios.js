import config from '../config'
import axios from 'axios'

var axiosInstance = axios
axiosInstance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axiosInstance.defaults.baseURL = config.AXIOS_BASE_URL
axiosInstance.interceptors.response.use(null, function (error) {
    if (error.response) {
      console.log(error.response.data)
      console.log(error.response.status)
      console.log(error.response.headers)
    } else if (error.request) {
      console.log(error.request)
    } else {
      console.log('Error', error.message)
    }
    console.log(error.config)
    return Promise.reject(error)
});


export default axiosInstance