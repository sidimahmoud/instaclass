import axios from "axios";
import i18n from "./src/i18n";

require('./bootstrap');

window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('appnav', require('./components/header/NavbarCompnent.vue').default);
Vue.component('appfooter', require('./components/FooterComponent.vue').default);
Vue.component('appmail', require('./components/MailBox.vue').default);
Vue.component('Login', require('./components/auth/Login').default);
Vue.component('Register', require('./components/auth/Register').default);

import store from './store'
import router from './router'
import Home from './components/HomeCompnent'
import VueSimpleAlert from "vue-simple-alert";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(VueSimpleAlert);
import FBSignInButton from 'vue-facebook-signin-button'
Vue.use(FBSignInButton)
import GSignInButton from 'vue-google-signin-button'
Vue.use(GSignInButton)
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'
import { Button, Select } from 'element-ui';

Vue.use(ElementUI, { locale })
Vue.component(Button.name, Button);
Vue.component(Select.name, Select);
import DropdownMenu from 'v-dropdown-menu'
import 'v-dropdown-menu/dist/v-dropdown-menu.css' // Base style, required.

Vue.use(DropdownMenu)  

import firebase from "firebase";

// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyDQKWF5BYza7riL0uOf3ZZc4sGNu585r5k",
    authDomain: "instaclass-9f27f.firebaseapp.com",
    databaseURL: "https://instaclass-9f27f.firebaseio.com",
    projectId: "instaclass-9f27f",
    storageBucket: "instaclass-9f27f.appspot.com",
    messagingSenderId: "65860975297",
    appId: "1:65860975297:web:514d38a733c6fc3410f240",
    measurementId: "G-DC3QX6XYTR"
};
firebase.initializeApp(firebaseConfig);


const app = new Vue({
    el: '#app',
    store,
    router,
    i18n,
    components: {
        Home,
    },
    created() {
        // this.$swal.fire({
        //     title: 'Error!',
        //     text: 'Do you want to continue',
        //     icon: 'error',
        //     confirmButtonText: 'Cool'
        // })
    },
    watch: {
        '$route'(to, from) {
            document.title = "Instantaclasse | " + to.meta.title
        }
    },
});
