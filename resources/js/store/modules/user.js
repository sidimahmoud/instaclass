import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    enrollments: '',
    TeacherCourses: '',
    teacherDetails: '',
    teacherPayments: '',
    profileLoading: false,
};
const getters = {
    userProfile: (state) => state.profile,
    userCourses: (state) => state.courses,
    TeacherCourses: (state) => state.TeacherCourses,
    userEnrollments: (state) => state.enrollments,
    allTeacherDetails: (state) => state.teacherDetails,
    allTeacherPayments: (state) => state.teacherPayments,
    profileLoading: (state) => state.profileLoading,
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
        commit('setTeacherDetails', response.data);
    },
    async fetchTeacherPayments({commit}) {
        header();
        const response = await axios.get('https://instantclass.herokuapp.com/api/teacher/payments');
        console.log(response.data);
        commit('setTeacherPayments', response.data);
    },

    async fetchUserCourses({commit}) {
        commit('setProfileLoading', true);
        header();
        const response = await axios.get(`https://instantclass.herokuapp.com/api/user/courses`);
        commit('setCourses', response.data);
        commit('setProfileLoading', false);
    },
    async fetchUserEnrollments({commit}) {
        commit('setProfileLoading', true);
        header();
        const response = await axios.get(`https://instantclass.herokuapp.com/api/user/enrollments`);
        commit('setEnrollments', response.data);
        commit('setProfileLoading', false);

    },
};

const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setCourses: (state, payload) => (state.courses = payload),
    setEnrollments: (state, payload) => (state.enrollments = payload),
    setTeacherCourses: (state, payload) => (state.TeacherCourses = payload),
    setTeacherDetails: (state, payload) => (state.teacherDetails = payload),
    setTeacherPayments: (state, payload) => (state.teacherPayments = payload),
    setProfileLoading: (state, val) => (state.profileLoading = val),

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
