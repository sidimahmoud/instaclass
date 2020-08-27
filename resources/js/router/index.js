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
import SearchCourses from "../components/courses/SearchCourses";

import Become from "../components/teacher/Become";
import Signin from "../components/teacher/Signin";
import TeacherProfile from "../components/teacher/Profile";
import StudentProfile from "../components/student/Profile";
import EditProfile from "../components/student/EditProfile";

import Dashboard from "../components/admin/Dashboard";
import LoginAdmin from "../components/admin/auth/Login";

import Homefr from "../components/fr/Homefr";
import CategoryCourses from "../components/courses/CategoryCourses";

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
        path: '/category/:id/courses',
        name: 'CategCourses',
        component: CategoryCourses,
        meta: {
            requiresAuth: false,
            title: 'Courses'
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
        path: '/courses/search/q=:q',
        name: 'Search',
        component: SearchCourses,
        meta: {
            requiresAuth: false,
            title: 'Search'

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
        path: '/player/live/:slug',
        name: 'Live',
        component: Live,
        meta: {
            requiresAuth: true,
            title: 'Live course'

        }
    },
    {
        path: '/checkout/:slug',
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
            if (user.t === "teacher") next();
            else if (user.t === "admin") next({name: 'Admin'});
            else if (user.t === "student") next({name: 'StudentProfile'});
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
        },
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "student") next();
            else if (user.t === "admin") next({name: 'Admin'});
            else if (user.t === "teacher") next({name: 'TeacherProfile'});
            else next({name: 'Home'});
        },
    },
    {
        path: '/profile/edit',
        name: 'EditProfile',
        component: EditProfile,
        meta: {
            requiresAuth: true,
            title: 'Edit Profile'
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
        path: '/admin/login',
        name: 'LoginAdmin',
        component: LoginAdmin,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/admin',
        name: 'Admin',
        component: Dashboard,
        meta: {
            requiresAuth: false,
            title: 'Admin',
            admin: true
        },
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) {
                next({name: 'LoginAdmin'});
            } else {
                let user = JSON.parse(localStorage.getItem('user')) || null;
                if (user.t === "admin") next();
                else if (user.t === "teacher") next({name: 'TeacherProfile'});
                else if (user.t === "student") next({name: 'StudentProfile'});
                else next({name: 'Home'});
            }

        },
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

