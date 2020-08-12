import axios from 'axios'

const state = {
    categories: [],
    course: '',
    loadingCategories: false,

};
const getters = {
    allCategories: (state) => state.categories,
    loadingCategories: (state) => state.loadingCategories,
};

const actions = {
    async fetchCategories({commit}) {
        commit('loadingCategories', true);
        const response = await axios.get('https://instantclass.herokuapp.com/api/categories');
        commit('setCategories', response.data);
        commit('loadingCategories', false);

    },

};
const mutations = {
    setCategories: (state, categories) => (state.categories = categories),
    loadingCategories: (state, val) => (state.loadingCategories = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
