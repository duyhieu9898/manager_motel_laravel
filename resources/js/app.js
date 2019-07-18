/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

const token = 'be81524776d1a1cf18f877aca7fb740fdecf9b69a7c5e6f8cc1a125b7b2d3d12'
axios.defaults.baseURL = window.location.origin
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

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
import money from 'v-money'

// register directive v-money and component <money>
Vue.use(money, { precision: 3 })

Vue.use(BootstrapVue)
Vue.use(CKEditor);
Vue.use(VueRouter);

Vue.component('user-component', require('./components/User.vue').default);
Vue.component('room-photo-component', require('./components/RoomPhoto.vue').default);
Vue.component('room-address-component', require('./components/RoomAddress.vue').default);
Vue.component('app-admin-component', require('./components/AppAdmin.vue').default);
Vue.component('room-convenients-component', require('./components/RoomConvenients.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import TheListRooms from './components/TheListRooms.vue';
import TheRoomEdit from './components/TheRoomEdit.vue';
import TheRoomCreate from './components/TheRoomCreate.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/app',
            name: 'all-room',
            component: TheListRooms
        },
        {
            path: '/app/admin/rooms/:id/edit',
            name: 'room-edit',
            component: TheRoomEdit
        },
        {
            path: '/app/admin/rooms/create',
            name: 'room-create',
            component: TheRoomCreate
        }
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});




const app = new Vue({
    el: '#app',
    router,
});