import Vue from 'vue'
import store from './store'
import axios from './axios.js'
import App from "./App";

// Vue Router
import router from './router'


Vue.config.productionTip = false

Vue.prototype.$http = axios

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
