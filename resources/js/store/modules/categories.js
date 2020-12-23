import axios from 'axios'

const state = {
    categories: [],
    nonCategories: {},
    subCategories: [],
    course: '',
    loadingCategories: false,

};
const getters = {
    allCategories: (state) => state.categories,
    nonCategories: (state) => state.nonCategories,
    subCategories: (state) => state.subCategories,
    loadingCategories: (state) => state.loadingCategories,
};

const actions = {
    async fetchCategories({commit}) {
        commit('loadingCategories', true);
        const response = await axios.get('/categories');
        commit('setCategories', response.data);
        commit('loadingCategories', false);
    },
    async fetchNoCategorie({commit}) {
        commit('loadingCategories', true);
        const response = await axios.get('/non-categories');
        commit('setNonCategories', response.data);
        commit('loadingCategories', false);
    },
    async fetchSubCategories({commit}, id) {
        commit('loadingCategories', true);
        const response = await axios.get('/subcats/' + id);
        commit('setSubCategories', response.data);
        commit('loadingCategories', false);
    },
    async deleteCategory({commit}, id) {
        return new Promise((resolve, reject) => {
            axios.delete('/categories/' + id)
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
    setCategories: (state, categories) => (state.categories = categories),
    setNonCategories: (state, nonCategories) => (state.nonCategories = nonCategories),
    setSubCategories: (state, categories) => (state.subCategories = categories),
    loadingCategories: (state, val) => (state.loadingCategories = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
