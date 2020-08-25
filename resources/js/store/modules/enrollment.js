import axios from 'axios'

const state = {


};
const getters = {

};

const actions = {
    async enroll({commit}, payload) {
        headers();
        return new Promise((resolve, reject) => {
            axios({url: 'https://instantclass.herokuapp.com/api/enroll', data: payload, method: 'POST'})
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },

};
const mutations = {

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
