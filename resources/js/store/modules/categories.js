import axios from 'axios'

const state = {
    categories: [],
    course: '',
    loading: false,

};
const getters = {
    allCategories: (state) => state.categories,
    category: (state) => state.category,
};

const actions = {
    async fetchCourses({commit}) {
        commit('setLoading', true);
        const response = await axios.get('https://instantclass.herokuapp.com/api/categories');
        commit('setCourses', response.data);
        commit('setLoading', false);

    },
    async getCourse({commit}, slug) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/categories/${slug}`);
        commit('setCourse', response.data[0]);
        commit('setLoading', false);
    },
};
const mutations = {
    setCourses: (state, categories) => (state.categories = categories),
    setCourse: (state, category) => (state.category = category),
    setLoading: (state, val) => (state.loading = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
