import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import courses from './modules/courses';
import user from "./modules/user";
import categories from "./modules/categories";
import users from "./modules/admin/users";
import payments from "./modules/admin/payments";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        auth,
        courses,
        user,
        categories,
        users,
        payments
    }
})

