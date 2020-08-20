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
import Live from "../components/courses/Live";

import Become from "../components/teacher/Become";
import Signin from "../components/teacher/Signin";
import TeacherProfile from "../components/teacher/Profile";
import StudentProfile from "../components/student/Profile";

import Dashboard from "../components/admin/Dashboard";
import AdminCourses from "../components/admin/courses/Courses";
import Users from "../components/admin/users/Teachers";

import Homefr from "../components/fr/Homefr";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requiresAuth: false,
            title: 'Home'

        }
    },
    {
        path: '/about',
        name: 'About',
        component: About,
        meta: {
            requiresAuth: false,
            title: 'About'

        }
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Countact,
        meta: {
            requiresAuth: false,
            title: 'Contact'

        }
    },
    {
        path: '/courses',
        name: 'Courses',
        component: Courses,
        meta: {
            requiresAuth: false,
            title: 'Course'

        }
    },
    {
        path: '/courses/:slug',
        name: 'Detail',
        component: Details,
        meta: {
            requiresAuth: false,
            title: 'Course details'

        }
    },
    {
        path: '/course/demande',
        name: 'Demande',
        component: Demande,
        meta: {
            requiresAuth: false,
            title: 'Demande'

        }
    },
    {
        path: '/player/:slug',
        name: 'Player',
        component: CoursePlayer,
        meta: {
            requiresAuth: true,
            title: 'Course player'

        }
    },
    {
        path: '/player/live',
        name: 'Live',
        component: Live,
        meta: {
            requiresAuth: true,
            title: 'Live course'

        }
    },
    {
        path: '/checkout',
        name: 'Checkout',
        component: Checkout,
        meta: {
            requiresAuth: true,
            title: 'Checkout'

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
            title: 'Profile'

        }
    },
    {
        path: '/teacher/login',
        name: 'Signin',
        component: Signin,
        meta: {
            requiresAuth: false,
            title: 'Login'

        }
    },
    {
        path: '/teacher/register',
        name: 'Become',
        component: Become,
        meta: {
            requiresAuth: false,
            title: 'Become instructor'

        }
    },
    {
        path: '/student/profile',
        name: 'StudentProfile',
        component: StudentProfile,
        meta: {
            requiresAuth: true,
            title: 'Profile'

        }
    },

    {
        path: '/auth/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Login'

        }
    },
    {
        path: '/authorize/callback',
        name: 'Github',
        component: LoginGuithub,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Authorizing'

        }
    },
    {
        path: '/auth/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Register'

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

    // Admin routes
    {
        path: '/admin',
        name: 'Admin',
        component: Dashboard,
        meta: {
            requiresAuth: true,
            title:'Admin',
            admin: true
        }
        // children: [
        //     {
        //         path: 'teachers',
        //         name: 'AdminUsers',
        //         component: Users,
        //     },
        //     {
        //         path: 'courses',
        //         name: 'AdminCourses',
        //         component: AdminCourses,
        //     },
        // ]
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

