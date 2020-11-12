import axios from 'axios'

const state = {
    emails: '',
};
const getters = {
    emails: (state) => state.emails,
};

const actions = {
    async fetchEmails({commit}) {
        await axios.get('/newsletter').then(response =>{
            commit('setEmails', response.data);
        }).catch(err =>{
            console.log(err.response)
        })
    },
};

const mutations = {
    setEmails: (state, payload) => (state.emails = payload),

};

export default {
    state,
    getters,
    actions,
    mutations
}
