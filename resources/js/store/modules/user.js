import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    enrollments: '',
    TeacherCourses: '',
    teacherDetails: '',
    teacherPayments: '',
};
const getters = {
    userProfile: (state) => state.profile,
    userCourses: (state) => state.courses,
    TeacherCourses: (state) => state.TeacherCourses,
    userEnrollments: (state) => state.enrollments,
    allTeacherDetails: (state) => state.teacherDetails,
    allTeacherPayments: (state) => state.teacherPayments,
};

const actions = {
    async fetchProfile({commit}) {
        header();
        const response = await axios.get('https://instantclass.herokuapp.com/api/user');
        commit('setProfile', response.data[0]);
    },
    async fetchTeacherCourses({commit}, id) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/teacher/${id}/courses`);
        commit('setTeacherCourses', response.data);
    },
    async fetchTeacherDetails({commit}) {
        header();
        const response = await axios.get('https://instantclass.herokuapp.com/api/teacher/details');
        console.log(response.data)
        commit('setTeacherDetails', response.data);
    },
    async fetchTeacherPayments({commit}) {
        header();
        const response = await axios.get('https://instantclass.herokuapp.com/api/teacher/payments');
        console.log(response.data);
        commit('setTeacherPayments', response.data[0]);
    },

    async fetchUserCourses({commit}) {
        header();
        const response = await axios.get(`https://instantclass.herokuapp.com/api/user/courses`);
        commit('setCourses', response.data);
    },
    async fetchUserEnrollments({commit}) {
        header();
        const response = await axios.get(`https://instantclass.herokuapp.com/api/user/enrollments`);
        commit('setEnrollments', response.data);
    },
};

const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setCourses: (state, payload) => (state.courses = payload),
    setEnrollments: (state, payload) => (state.enrollments = payload),
    setTeacherCourses: (state, payload) => (state.TeacherCourses = payload),
    setTeacherDetails: (state, payload) => (state.teacherDetails = payload),
    setTeacherPayments: (state, payload) => (state.teacherPayments = payload),
};

function header() {
    let token = localStorage.getItem('token') || '';
    if (token) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
