/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap')
//config
const token = 'aac7be0fadb22ce91215aac89b01003a1d873899edc6c10b0212aba24b40b885'
axios.defaults.baseURL = window.location.origin
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
window.Vue = require('vue')
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import BootstrapVue from 'bootstrap-vue'
import money from 'v-money'
import VeeValidate from 'vee-validate'
import { Validator } from 'vee-validate'
import Chat from 'vue-beautiful-chat'
import store from './store'
//Overwriting messages errors
const dictionary = {
    en: {
        attributes: {
            email_create: 'Email Address',
            username_create: 'User name',
            phone_create: 'Phone Number',
            email: 'Email Address',
            username: 'User name',
            phone: 'Phone Number',
        }
    },
}

Validator.localize(dictionary)
// register directive v-money and component <money>
Vue.use(money, { precision: 3 })
Vue.use(BootstrapVue)
Vue.use(VeeValidate)
Vue.use(Chat)
//Register component in app
Vue.component('user-address-component', require('./components/UserAddress.vue').default)
Vue.component('info-user-component', require('./components/InfoUser.vue').default)
Vue.component('chat-application', require('./components/ChatApplicationPusher.vue').default)

//import component for VueRoute
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const vm = new Vue({
    el: '#app',
    store,
    mounted() {
        store.dispatch('currentUser')
    }
})
