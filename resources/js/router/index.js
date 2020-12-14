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
import BuyOneSection from "../components/checkout/BuyOneSection";

import Details from "../components/courses/CourseDetails";
import Courses from "../components/courses/Courses";
import CoursePlayer from "../components/courses/CoursePlayer";
import Demande from "../components/courses/Demande";
import Live from "../components/student/Live";
import LiveVideo from "../components/student/LiveVideo";
import SearchCourses from "../components/courses/SearchCourses";

import Become from "../components/teacher/Become";
import Signin from "../components/teacher/Signin";
import TeacherProfile from "../components/teacher/Profile";
import StudentProfile from "../components/student/Profile";
import EditStudentProfile from "../components/teacher/EditProfile";
import Teacherpayments from "../components/teacher/Payments";
import Studentpayments from "../components/student/Payments";
import TeacherRatings from "../components/teacher/Ratings";
import StudentRatings from "../components/student/Ratings";
import TeacherInfo from "../components/teacher/EditProfile";


import Dashboard from "../components/admin/Dashboard";
import LoginAdmin from "../components/admin/auth/Login";

import CategoryCourses from "../components/courses/CategoryCourses";
import NewCourse from "../components/teacher/NewCourse";
import EditCourse from "../components/teacher/EditCourse";
import NewSection from "../components/teacher/NewSection";
import StartLive from "../components/teacher/StartLive";
import LiveCourse from "../components/teacher/LiveCourse";
import FAQ from "../components/FAQ";
import Terms from "../components/Terms";
import ForgotPassword from "../components/auth/ForgotPassword";
import ResetPasswordForm from "../components/auth/ResetPasswordForm";

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
        path: '/terms',
        name: 'Terms',
        component: Terms,
        meta: {
            requiresAuth: false,
            title: 'Terms of use'

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
            title: 'Categorie Courses'
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
        path: '/player/live/:slug/:sid',
        name: 'Live',
        component: Live,
        meta: {
            requiresAuth: true,
            title: 'Live course'
        }
    },
    {
        path: '/player/livevideo/:slug/:sid',
        name: 'LiveVideo',
        component: LiveVideo,
        meta: {
            requiresAuth: true,
            title: 'Live course',
            liveVideo: true
        }
    },
    {
        path: '/livecourse/:title',
        name: 'LiveCourse',
        component: LiveCourse,
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
        path: '/startlive',
        name: 'StartLive',
        component: StartLive,
        meta: {
            requiresAuth: true,
            title: 'Start Live',
            startLive: true
        }
    },
    {
        path: '/checkout/:slug',
        name: 'Checkout',
        component: Checkout,
        meta: {
            requiresAuth: true,
            title: 'Checkout'
        },
        props: true 
    },
    {
        path: '/checkout/:id/:slug',
        name: 'BuyOneSection',
        component: BuyOneSection,
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
            if (user.edited == 0) next({name: 'TeacherInfo'});
            else if (user.t === "teacher") next();
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
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user && user.t === "teacher") next({name: 'TeacherProfile'});
            else next()
        },
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
            if (user && user.t === "teacher") next({name: 'TeacherProfile'});
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
            if (user.edited == 0) next({name: 'TeacherInfo'});
            else if (user.t === "student") next();
            else if (user.t === "admin") next({name: 'Admin'});
            else if (user.t === "teacher") next({name: 'TeacherProfile'});
            else next({name: 'Home'});
        },
    },

    {
        path: '/student/edit',
        name: 'EditStudentProfile',
        component: EditStudentProfile,
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
        path: '/reset-password',
        name: 'ResetPassword',
        component: ForgotPassword,
        meta: {

            title: 'Reset password'
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
            auth: false
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
    {
        path: '/students/payments',
        name: 'Studentpayments',
        component: Studentpayments,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "student") next();
            else if (user.t === "teacher") next({name: 'Teacherpayments'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
            title: 'Profile'
        }
    },
    {
        path: '/teacher/payments',
        name: 'Teacherpayments',
        component: Teacherpayments,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next();
            else if (user.t === "student") next({name: 'Studentpayments'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
            title: 'Profile'
        }
    },
    {
        path: '/students/ratings',
        name: 'StudentRatings',
        component: StudentRatings,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "student") next();
            else if (user.t === "teacher") next({name: 'TeacherRatings'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
            title: 'Profile'
        }
    },
    {
        path: '/teacher/ratings',
        name: 'TeacherRatings',
        component: TeacherRatings,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next();
            else if (user.t === "student") next({name: 'StudentRatings'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
            title: 'Profile'
        }
    },
    {
        path: '/teacher/edit-profile',
        name: 'TeacherInfo',
        component: TeacherInfo,
        beforeEnter: (to, from, next) => {
            let user = JSON.parse(localStorage.getItem('user')) || null;
            if (user.t === "teacher") next();
            else if (user.t === "student") next({name: 'EditStudentProfile'});
            else next({name: 'Home'});
        },
        meta: {
            requiresAuth: true,
            title: 'Profile'
        }
    },
];

const router = new VueRouter({
    mode: 'history',
    // base: process.env.MIX_API_URL,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return
        }
        next({
            name: 'Login',
            query: {redirect: to.fullPath}
        })
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

