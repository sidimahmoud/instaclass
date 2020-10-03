import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    enrollments: '',
    TeacherCourses: '',
    teacherDetails: '',
    teacherPayments: '',
    profileLoading: false,
    loadingEnrollments: false,
};
const getters = {
    userProfile: (state) => state.profile,
    userCourses: (state) => state.courses,
    TeacherCourses: (state) => state.TeacherCourses,
    userEnrollments: (state) => state.enrollments,
    allTeacherDetails: (state) => state.teacherDetails,
    allTeacherPayments: (state) => state.teacherPayments,
    profileLoading: (state) => state.profileLoading,
    loadingEnrollments: (state) => state.loadingEnrollments,
};

const actions = {
    async fetchProfile({commit}) {
        const response = await axios.get('/user');
        commit('setProfile', response.data[0]);
    },
    async fetchTeacherCourses({commit}, id) {
        const response = await axios.get(`/teacher/${id}/courses`);
        commit('setTeacherCourses', response.data);
    },
    async fetchTeacherDetails({commit}) {
        const response = await axios.get('/teacher/details');
        commit('setTeacherDetails', response.data);
    },
    async fetchTeacherPayments({commit}) {
        const response = await axios.get('/teacher/payments');
        console.log(response.data);
        commit('setTeacherPayments', response.data);
    },

    async fetchUserCourses({commit}) {
        commit('setProfileLoading', true);
        const response = await axios.get(`/user/courses`);
        commit('setCourses', response.data);
        commit('setProfileLoading', false);
    },
    async fetchUserEnrollments({commit}) {
        commit('setProfileLoading', true);
        const response = await axios.get(`/enrollments`);
        commit('setEnrollments', response.data[0]);
        console.log(response.data[0])
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
    setloadingEnrollments: (state, val) => (state.loadingEnrollments = val),
};

export default {
    state,
    getters,
    actions,
    mutations
}
