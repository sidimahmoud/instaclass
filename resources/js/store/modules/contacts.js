import axios from 'axios'

const state = {
    contacts:[],
    loading: false,
};
const getters = {
    loading: (state) => state.loading,
};

const actions = {

    async contacter({commit}, payload) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({url: 'https://instantclass.herokuapp.com/api/contacter', data: payload, method: 'POST'})
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
    async fetchContacts({commit}) {
        commit('setLoading', true);
        const response = await axios.get(`https://instantclass.herokuapp.com/api/contacts`);
        commit('setContcts', response.data);
        commit('setLoading', false);
    },

};
const mutations = {
    setContcts: (state, payload) => (state.contacts = payload),

    setLoading: (state, val) => (state.loading = val),
};
export default {
    state,
    getters,
    actions,
    mutations
}
