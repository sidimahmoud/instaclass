import axios from 'axios'

const state = {
    courses: [],
    course: '',
    loading: false,

};
const getters = {
    allCourses: (state) => state.courses,
    course: (state) => state.course,
    loading: (state) => state.loading,
};

const actions = {
    async fetchCourses({commit}) {
        commit('setLoading', true);
        const response = await axios.get('https://instantclass.herokuapp.com/api/courses');
        commit('setCourses', response.data);
        commit('setLoading', false);

    },
    async getCourse({commit}, slug) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/courses/${slug}`);
        commit('setCourse', response.data[0]);
        commit('setLoading', false);
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
