import axios from 'axios'

const state = {
    profile: '',
    courses: '',
};
const getters = {
    userProfile: (state) => state.profile,
    userCourses: (state) => state.courses,
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
};
const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setCourses: (state, courses) => (state.courses = courses),
};
export default {
    state,
    getters,
    actions,
    mutations
}
