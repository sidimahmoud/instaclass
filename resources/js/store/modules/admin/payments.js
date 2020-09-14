import axios from 'axios'

const state = {
    received: [],
    sent: [],

};
const getters = {
    allReceived: (state) => state.received,
    allSent: (state) => state.sent,
};

const actions = {
    async fetchReceived({commit}) {
        headers();
        const response = await axios.get('/payments/received');
        commit('setReceived', response.data);
    },
    async fetchSent({commit}) {
        headers();
        const response = await axios.get('/payments/sent');
        commit('setSent', response.data);
    },

};
const mutations = {
    setReceived: (state, payload) => (state.received = payload),
    setSent: (state, payload) => (state.sent = payload),
};

function headers() {
    let token = localStorage.getItem('token') || '';
    if (token) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
