/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

const token = 'aef20e94e80340ce4c5a2952879e7387bc1cb6d533f275e3fd0c9888b377b9a1'
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
import ToggleButton from 'vue-js-toggle-button'
// import VueSweetalert2 from 'vue-sweetalert2';





// register directive v-money and component <money>
Vue.use(money, { precision: 3 })
Vue.use(BootstrapVue)
Vue.use(CKEditor);
Vue.use(VueRouter);
Vue.use(ToggleButton)
    // Vue.use(VueSweetalert2);

Vue.component('room-photo-component', require('./components/RoomPhoto.vue').default);
Vue.component('room-address-component', require('./components/RoomAddress.vue').default);
Vue.component('user-address-component', require('./components/UserAddress.vue').default);
Vue.component('app-admin-component', require('./components/AppAdmin.vue').default);
Vue.component('room-convenients-component', require('./components/RoomConvenients.vue').default);
Vue.component('todo-list-component', require('./components/TodoList.vue').default);
Vue.component('user-component', require('./components/TheUser.vue').default);
Vue.component('contact-form-component', require('./components/ContactForm.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import TheListRooms from './components/TheListRooms.vue';
import TheRoomEdit from './components/TheRoomEdit.vue';
import TheRoomCreate from './components/TheRoomCreate.vue';
import TheUser from './components/TheUser.vue';
import TheDashBoard from './components/TheDashBoard.vue';
import TheBooking from './components/TheBooking.vue';
import TheCategory from './components/TheCategory.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/admin',
            name: 'dash-board',
            component: TheDashBoard
        },
        {
            path: '/admin/rooms',
            name: 'all-room',
            component: TheListRooms
        },
        {
            path: '/admin/rooms/:id/edit',
            name: 'room-edit',
            component: TheRoomEdit
        },
        {
            path: '/admin/rooms/create',
            name: 'room-create',
            component: TheRoomCreate
        },
        {
            path: '/admin/users',
            name: 'user',
            component: TheUser
        },
        {
            path: '/admin/bookings',
            name: 'booking',
            component: TheBooking
        },
        {
            path: '/admin/categories',
            name: 'categories',
            component: TheCategory
        }
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            // return new Promise((resolve, reject) => {
            //         setTimeout(() => {
            //             resolve({ x: 0, y: 0 })
            //         }, 500)
            //     })
            return { x: 0, y: 0 }
        }
    }
});




const app = new Vue({
    el: '#app',
    router,
});
