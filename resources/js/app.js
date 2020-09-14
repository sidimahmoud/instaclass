import axios from "axios";

require('./bootstrap');

window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('appnav', require('./components/header/NavbarCompnent.vue').default);
Vue.component('appfooter', require('./components/FooterComponent.vue').default);

Vue.component('Home', require('./components/HomeCompnent.vue').default);
 axios.defaults.baseURL = "https://instantclass.herokuapp.com/api";


import store from './store'
import router from './router'
import Home from './components/HomeCompnent'
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        Home
    },
    watch: {
        '$route'(to, from) {
            document.title = "Instantclass | " + to.meta.title
        }
    },
});
