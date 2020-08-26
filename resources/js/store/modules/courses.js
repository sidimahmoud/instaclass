import axios from 'axios'

const state = {
    courses: [],
    course: '',
    categCourses: [],
    loading: false,
};
const getters = {
    allCourses: (state) => state.courses,
    allcategCourses: (state) => state.categCourses,
    course: (state) => state.course,
    loading: (state) => state.loading,
};

const actions = {
    async fetchCourses({commit}, page) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/courses?page=${page}`);
        console.log(response.data);
        commit('setCourses', response.data);
        commit('setLoading', false);
    },
    async getCourse({commit}, slug) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/courses/${slug}`);
        commit('setCourse', response.data[0]);
        commit('setLoading', false);
    },
    async search({commit}, q) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/courses/search/${q}`);
        commit('setCourses', response.data);
        commit('setLoading', false);
    },
    async demander({commit}, payload) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({url: 'https://instantclass.herokuapp.com/api/courses/demander', data: payload, method: 'POST'})
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
    async getCategoryCourses({commit}, id) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/class/${id}`);
        commit('setCategoryCourses', response.data);
        commit('setLoading', false);
    },
};
const mutations = {
    setCourses: (state, courses) => (state.courses = courses),
    setCourse: (state, course) => (state.course = course),
    setCategoryCourses: (state, payload) => (state.categCourses = payload),
    setLoading: (state, val) => (state.loading = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
