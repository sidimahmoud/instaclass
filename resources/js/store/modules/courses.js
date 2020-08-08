import axios from 'axios'

const state = {
    courses: [],
    course: [],
    loading: false

};

const getters = {
    allCourses: (state) => state.courses,
    course: (state) => state.course,
    loading: (state) => state.loading,

};

const actions = {
    async fetchCourses({commit}) {
        const response = await axios.get('http://instantclass.ca/api/courses/');
        commit('setCourses', response.data);
    },
    async getCourse({commit}, slug) {
        commit('setLoading', true);
        const response = await axios.get(`http://instantclass.ca/api/courses/${slug}`);
        setTimeout(() => {
                commit('setLoading', false);
            }, 100);
        commit('setCourse', response.data[0]);
    },

};

const mutations = {
    setCourses: (state, courses) => (state.courses = courses),
    setCourse: (state, course) => (state.course = course),
    setLoading: (state, val) => (state.loading = val),
};

export default {
    state,
    getters,
    actions,
    mutations
}
