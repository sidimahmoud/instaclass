import axios from "axios";
import i18n from "./src/i18n";

require('./bootstrap');

window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('appnav', require('./components/header/NavbarCompnent.vue').default);
Vue.component('appfooter', require('./components/FooterComponent.vue').default);
Vue.component('Login', require('./components/auth/Login').default);
Vue.component('Register', require('./components/auth/Register').default);

import store from './store'
import router from './router'
import Home from './components/HomeCompnent'
import FBSignInButton from 'vue-facebook-signin-button'
import VueSimpleAlert from "vue-simple-alert";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(VueSimpleAlert);
Vue.use(FBSignInButton)
import GSignInButton from 'vue-google-signin-button'

Vue.use(GSignInButton)

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
            document.title = "Instantaclass | " + to.meta.title
        }
    },
});
