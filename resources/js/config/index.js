import global from './global.config'
import dev from './dev.config'
import prod from './prod.config'

let config = {}

if (process.env.NODE_ENV === 'development') {
  config = Object.assign(global, dev)
} else {
  config = Object.assign(global, prod)
}

export default config