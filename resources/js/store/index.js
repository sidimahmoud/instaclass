import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import courses from './modules/courses';
import user from "./modules/user";
import categories from "./modules/categories";
import users from "./modules/admin/users";
import payments from "./modules/admin/payments";
import enrollment from "./modules/enrollment";
import contacts from "./modules/contacts";
import liveCourses from "./modules/liveCourses";
import i18n from "../src/i18n";
import newsletter from "./modules/newsletter";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    getters:{
        lang : ()=>i18n.locale
    },
    mutations: {},
    actions: {},
    modules: {
        auth,
        courses,
        user,
        categories,
        users,
        payments,
        enrollment,
        contacts,
        liveCourses,
        newsletter
    }
})

