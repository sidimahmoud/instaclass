require('./bootstrap');

window.Vue = require('vue');



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('appnav', require('./components/header/NavbarCompnent.vue').default);
Vue.component('appfooter', require('./components/FooterComponent.vue').default);

Vue.component('Home', require('./components/HomeCompnent.vue').default);
Vue.component('About', require('./components/About.vue').default);

Vue.component('course', require('./components/courses/CourseComponent').default);
Vue.component('CourseDetail', require('./components/courses/CourseDetails').default);
Vue.component('Review', require('./components/courses/Review').default);

Vue.component('TeacherProfile', require('./components/teacher/Profile').default);
Vue.component('StudentProfile', require('./components/student/Profile').default);

Vue.component('Login', require('./components/auth/Login').default);
Vue.component('Register', require('./components/auth/Register').default);


import store from './store'
import router from './router'
import Home from './components/HomeCompnent'
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        Home
    }


});
