import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

import Login from "../components/auth/Login";
import LoginGuithub from "../components/auth/LoginGuithub";
import Register from "../components/auth/Register";

import Home from "../components/HomeCompnent";
import About from "../components/About";
import Countact from "../components/ContactCompo";
import Checkout from "../components/checkout/Checkout";

import Details from "../components/courses/CourseDetails";
import Courses from "../components/courses/Courses";
import CoursePlayer from "../components/courses/CoursePlayer";
import Demande from "../components/courses/Demande";

import Become from "../components/teacher/Become";
import TeacherProfile from "../components/teacher/Profile";
import StudentProfile from "../components/student/Profile";

import Homefr from "../components/fr/Homefr";
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/about',
        name: 'About',
        component: About,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Countact,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/courses',
        name: 'Courses',
        component: Courses,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/courses/:slug',
        name: 'Detail',
        component: Details,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/course/demande',
        name: 'Demande',
        component: Demande,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/player/:slug',
        name: 'Player',
        component: CoursePlayer,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/checkout',
        name: 'Checkout',
        component: Checkout,
        meta: {
            requiresAuth: true,
        }
    },

    {
        path: '/teacher/profile',
        name: 'TeacherProfile',
        component: TeacherProfile,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === 'teacher') next();
            else if (user.t === 'student') next({name: 'StudentProfile'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/teacher/register',
        name: 'Become',
        component: Become,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/student/profile',
        name: 'StudentProfile',
        component: StudentProfile,
        meta: {
            requiresAuth: true,
        }
    },

    {
        path: '/auth/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
        }
    },
    {
        path: '/authorize/callback',
        name: 'Github',
        component: LoginGuithub,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
        }
    },
    {
        path: '/auth/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
        }
    },

    // fr routes
    {
        path: '/fr',
        name: 'HomeFr',
        component: Homefr,
        meta: {
            requiresAuth: false,
        }
    },
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return
        }
        next({name: 'Login'})
    } else if (to.matched.some(record => record.meta.requiresVisitore)) {
        if (!store.getters.isLoggedIn) {
            next();
            return
        }
        next({name: 'Home'})
    } else {
        next()
    }
});
export default router

