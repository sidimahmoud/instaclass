import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

import Login from "../components/auth/Login";
import LoginGoogle from "../components/auth/GoogleCallback";
import LoginFacebook from "../components/auth/FacebookCallback";
import Register from "../components/auth/Register";
import EmailConfirmation from "../components/auth/EmailConfirmation";

import Home from "../components/HomeCompnent";
import About from "../components/About";
import Contact from "../components/ContactCompo";
import Checkout from "../components/checkout/Checkout";

import Details from "../components/courses/CourseDetails";
import Courses from "../components/courses/Courses";
import CoursePlayer from "../components/courses/CoursePlayer";
import Demande from "../components/courses/Demande";
import Live from "../components/student/Live";
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
import NewCourse from "../components/teacher/NewCourse";
import EditCourse from "../components/teacher/EditCourse";
import NewSection from "../components/teacher/NewSection";
import LiveWindowCompo from "../components/teacher/StartLive";
import FAQ from "../components/FAQ";

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
        path: '/faq',
        name: 'Faq',
        component: FAQ,
        meta: {
            requiresAuth: false,
            title: 'FAQ'

        }
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact,
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
        path: '/live/:slug',
        name: 'LiveCourse',
        component: LiveWindowCompo,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next();
            else if (user.t === "admin") next({name: 'Admin'});
            else if (user.t === "student") next({name: 'StudentProfile'});
            else next({name: 'Home'});
        },
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
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next({name: 'TeacherProfile'});
        },
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
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next({name: 'TeacherProfile'});
            else next()
        },
        meta: {
            requiresAuth: false,
            title: 'Become instructor'
        }
    },
    {
        path: '/teacher/courses/new',
        name: 'NewCourse',
        component: NewCourse,
        meta: {
            requiresAuth: true,
            title: 'Add new course'
        }
    },
    {
        path: '/teacher/edit/:slug',
        name: 'EditCourse',
        component: EditCourse,
        meta: {
            requiresAuth: true,
            title: 'Edit course'
        }
    },
    {
        path: '/teacher/course/add',
        name: 'AddSection',
        component: NewSection,
        meta: {
            requiresAuth: true,
            title: 'New session'
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
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Login'
        }
    },
    {
        path: '/authorize/google/callback',
        name: 'Google',
        component: LoginGoogle,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Authorizing'
        }
    },
    {
        path: '/authorize/facebook/callback',
        name: 'Facebook',
        component: LoginFacebook,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Authorizing'
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresAuth: false,
            requiresVisitore: true,
            title: 'Register'
        }
    },
    {
        path: '/auth/verify',
        name: 'Email',
        component: EmailConfirmation,
        meta: {
            requiresAuth: false,
            requiresVisitore: false,
            title: 'Email verification'
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
    // base: process.env.MIX_API_URL,
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

