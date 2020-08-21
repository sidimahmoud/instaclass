import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    TeacherCourses: '',
    enrollments: '',
};
const getters = {
    userProfile: (state) => state.profile,
    userCourses: (state) => state.courses,
    TeacherCourses: (state) => state.TeacherCourses,
    userEnrollments: (state) => state.enrollments,
};

const actions = {
    async fetchProfile({commit}) {
        let token = localStorage.getItem('token') || '';
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            const response = await axios.get('https://instantclass.herokuapp.com/api/user');
            commit('setProfile', response.data[0]);
        }

    },
    async fetchUserCourses({commit}) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/user/courses`);
        commit('setCourses', response.data);
    },
    async fetchTeacherCourses({commit}, id) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/teacher/${id}/courses`);
        commit('setTeacherCourses', response.data);
    },

    async fetchUserEnrollments({commit}) {
        let token = localStorage.getItem('token') || '';
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            const response = await axios.get(`https://instantclass.herokuapp.com/api/user/enrollments`);
            commit('setEnrollments', response.data);
        }
    },
};
const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setCourses: (state, payload) => (state.courses = payload),
    setTeacherCourses: (state, payload) => (state.TeacherCourses = payload),
    setEnrollments: (state, payload) => (state.enrollments = payload),
};
export default {
    state,
    getters,
    actions,
    mutations
}
