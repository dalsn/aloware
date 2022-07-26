require('./bootstrap')

import App from './App.vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import { routes } from './routes'

window.Vue = require('vue')

Vue.use(VueRouter)
Vue.use(axios)

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
})