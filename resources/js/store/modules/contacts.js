import axios from 'axios'

const state = {
    contacts:[],
};
const getters = {
};

const actions = {

    async contacter({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios({url: 'https://instantclass.herokuapp.com/api/contacter', data: payload, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    resolve(resp)
                })
                .catch(err => {
                    reject(err)
                })
        })
    },
    async fetchContacts({commit}) {
        const response = await axios.get(`https://instantclass.herokuapp.com/api/contacts`);
        commit('setContcts', response.data);
    },

};
const mutations = {
    setContcts: (state, payload) => (state.contacts = payload),

};
export default {
    state,
    getters,
    actions,
    mutations
}
