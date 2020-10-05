import axios from 'axios'

const state = {
    courses: [],
    course: '',
    categCourses: [],
    demands: [],
    loading: false,
    enrolled: false,
    statistics: '',
    enrolledStudents: '',
    upComing: ''
};
const getters = {
    allCourses: (state) => state.courses,
    allcategCourses: (state) => state.categCourses,
    allDemands: (state) => state.demands,
    allStatistics: (state) => state.statistics,
    course: (state) => state.course,
    loading: (state) => state.loading,
    enrolled: (state) => state.enrolled,
    getEnrolledStudents :(state)=>state.enrolledStudents,
    upComingSections :(state)=>state.upComing,

};


const actions = {
    async fetchCourses({commit}, page) {
        commit('setLoading', true);
        const response = await axios.get(`/courses?page=${page}`);
        commit('setCourses', response.data);
        commit('setLoading', false);
    },
    async getCourse({commit}, slug) {
        headers();
        commit('setLoading', true);
        const response = await axios.get(`/courses/${slug}`,);
        commit('setCourse', response.data[0]);
        console.log(response.data)
        const me = JSON.parse(localStorage.getItem('user')) || null;
        commit('setEnrolled', false);
        // if (me) {
        //     response.data.enrollments.map(item => {
        //         if (item.user_id === me.u) {
        //             commit('setEnrolled', true);
        //             console.log("enrolled")
        //         }
        //     })
        // }

        commit('setLoading', false);
    },
    async getSection({commit}, slug) {
        commit('setLoading', true);
        const response = await axios.get(`/sections/${slug}`,);
        commit('setCourse', response.data[0]);
        console.log(response.data)
        const me = JSON.parse(localStorage.getItem('user')) || null;
        commit('setEnrolled', false);
        // if (me) {
        //     response.data.enrollments.map(item => {
        //         if (item.user_id === me.u) {
        //             commit('setEnrolled', true);
        //             console.log("enrolled")
        //         }
        //     })
        // }

        commit('setLoading', false);
    },
    async getSectionEnrollments({commit}, id) {
        commit('setLoading', true);
        const response = await axios.get(`/enrolled-students/${id}`,);
        commit('setEnrollments', response.data);
        console.log(response.data)
        commit('setLoading', false);
    },
    async getUpcomingSections({commit}) {
        commit('setLoading', true);
        const response = await axios.get(`/upcoming-section`,);
        commit('setUpcoming', response.data);
        console.log(response.data)
        commit('setLoading', false);
    },
    async search({commit}, q) {
        commit('setLoading', true);
        const response = await axios.get(`/courses/search/${q}`);
        commit('setCourses', response.data);
        commit('setLoading', false);
    },
    async demander({commit}, payload) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({url: '/courses/demander', data: payload, method: 'POST'})
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
    async rateCourse({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios({url: 'https://instantclass.herokuapp.com/api/rate', data: payload, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    resolve(resp)
                })
                .catch(err => {
                    reject(err)
                })
        })
    },
    async enroll({commit}, payload) {
        commit('setLoading', true);
        return new Promise((resolve, reject) => {
            axios({url: '/enroll', data: payload, method: 'POST'})
                .then(resp => {
                    commit('setLoading', false);
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async enrollInAllSection({commit}, payload) {
        commit('setLoading', true);
        return new Promise((resolve, reject) => {
            axios({url: '/enroll-in-course', data: payload, method: 'POST'})
                .then(resp => {
                    commit('setLoading', false);
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async deleteCourse({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/course/' + id)
                .then(resp => {
                    console.log(resp);
                    resolve(resp)
                })
                .catch(err => {
                    reject(err)
                })
        })
    },

    async fetchDemands({commit}) {
        commit('setLoading', true);
        const response = await axios.get(`/demands`);
        commit('setDemands', response.data);
        commit('setLoading', false);
    },
    async fetchStatistics({commit}) {
        commit('setLoading', true);
        const response = await axios.get(`/statistics`);
        commit('setStatistics', response.data);
        commit('setLoading', false);
    },
    async getCategoryCourses({commit}, id) {
        commit('setLoading', true);
        const response = await axios.get(`/class/${id}`);
        commit('setCategoryCourses', response.data);
        commit('setLoading', false);
    },
    async saveSection({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios({url: '/course/sections', data: payload, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    resolve(resp)
                })
                .catch(err => {
                    reject(err)
                })
        })
    },
};
const mutations = {
    setCourses: (state, courses) => (state.courses = courses),
    setCourse: (state, course) => (state.course = course),
    setDemands: (state, payload) => (state.demands = payload),
    setCategoryCourses: (state, payload) => (state.categCourses = payload),
    setStatistics: (state, payload) => (state.statistics = payload),
    setEnrollments: (state, payload) => (state.enrolledStudents = payload),
    setUpcoming: (state, payload) => (state.upComing = payload),
    setLoading: (state, val) => (state.loading = val),
    setEnrolled: (state, val) => (state.enrolled = val),
};

function headers() {
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
