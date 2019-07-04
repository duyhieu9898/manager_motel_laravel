/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import VueRouter from 'vue-router';
import CKEditor from '@ckeditor/ckeditor5-vue';
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(CKEditor);
Vue.use(VueRouter);

Vue.component('user-component', require('./components/User.vue').default);
Vue.component('room-photo-component', require('./components/RoomPhoto.vue').default);
Vue.component('address-form-component', require('./components/AddressForm.vue').default);
Vue.component('admin-app-component', require('./components/AdminApp.vue').default);
Vue.component('convenients-form-component', require('./components/ConvenientsForm.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import ListRooms from './components/ListRooms.vue';
import RoomEdit from './components/RoomEdit.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/app',
            name: 'all-room',
            component: ListRooms
        },
        {
            path: '/app/admin/rooms/:id/edit',
            name: 'room',
            component: RoomEdit
        }
    ],
});

const app = new Vue({
    el: '#app',
    router,

});;