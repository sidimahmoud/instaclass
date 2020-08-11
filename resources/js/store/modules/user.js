import axios from 'axios'

const state = {
    profile: '',
    courses: '',
    loading: false,
};
const getters = {
    profile: (state) => state.profile,
    courses: (state) => state.courses,
    loading: (state) => state.loading,
};

const actions = {
    async fetchProfile({commit}) {
        const response = await axios.get('https://instantclass.herokuapp.com/api/user');
        commit('setProfile', response.data);
    },
    async fetchCourses({commit}, id) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/${id}/courses`);
        commit('setCourses', response.data);
    },
};
const mutations = {
    setProfile: (state, profile) => (state.profile = profile),
    setCourses: (state, courses) => (state.courses = courses),
    setLoading: (state, val) => (state.loading = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
