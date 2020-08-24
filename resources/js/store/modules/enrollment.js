import axios from 'axios'

const state = {


};
const getters = {

};

const actions = {
    async enroll({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios({url: 'https://instantclass.herokuapp.com/api/login', data: payload, method: 'POST'})
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
export default {
    state,
    getters,
    actions,
    mutations
}
