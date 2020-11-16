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
    studentPayments: '',
    upcomingClasses: '',
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
    studentPayments: (state) => state.studentPayments,
    upcomingClasses: (state) => state.upcomingClasses,
};

const actions = {
    async fetchProfile({commit, dispatch}) {
         await axios.get('/me').then(response =>{
             commit('setProfile', response.data[0]);
         }).catch(err =>{
             err.response.status===401?dispatch('logout'):"";
             location.reload()
         })
    },
    async fetchUpcomingClasses({commit, dispatch}) {
         await axios.get('/my-receipts').then(response =>{
             commit('setReceipts', response.data);
         }).catch(err =>{
             err.response.status===401?dispatch('logout'):"";
             location.reload()
         })
    },
    async fetchReceipts({commit, dispatch}) {
         await axios.get('/upcoming-classes').then(response =>{
             commit('setUpcomingClasses', response.data);
         })
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
        console.log(response)
        commit('setEnrollments', response.data);
        commit('setProfileLoading', false);

    },
    async addSpeciment({commit}, payload) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({url: '/add-speciment', data: payload, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    commit('setLoading', false);
                    resolve(resp)
                })
                .catch(err => {
                    reject(err)
                })
        })
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
    setReceipts: (state, payload) => (state.studentPayments = payload),
    setUpcomingClasses: (state, payload) => (state.upcomingClasses = payload),
};

export default {
    state,
    getters,
    actions,
    mutations
}
