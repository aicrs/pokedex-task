/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Route from './routes.js'
import Components from './components.js'
import App from './views/App'

import axios from 'axios'
Vue.prototype.$http = axios

const app = new Vue({
    el: '#app',
    router: Route,
    render: h => h(App)
});
