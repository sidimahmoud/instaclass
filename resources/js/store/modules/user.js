import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    enrollments: '',
};
const getters = {
    userProfile: (state) => state.profile,
    userEnrollments: (state) => state.enrollments,
};

const actions = {
    async fetchProfile({commit}) {
        let token = localStorage.getItem('token') || '';
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

            const response = await axios.get('https://instantclass.herokuapp.com/api/user');
            commit('setProfile', response.data);
        }

    },
    async fetchUserCourses({commit}, id) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/${id}/courses`);
        commit('setCourses', response.data);
    },

    async fetchUserEnrollments({commit}, id) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/${id}/enrollments`);
        commit('setEnrollments', response.data);
    },
};
const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setEnrollments: (state, payload) => (state.enrollments = payload),
};
export default {
    state,
    getters,
    actions,
    mutations
}
