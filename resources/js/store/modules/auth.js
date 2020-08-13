import axios from 'axios'

const state = {
    status: false,
    token: localStorage.getItem('token') || null,
    user: JSON.parse(localStorage.getItem('user')) || null,

};


const getters = {
    isLoggedIn: state => state.token,
    loggedInUser: state => state.user,
    authLoading: state => state.status,
};

const actions = {
    async login({commit}, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios({url: 'https://instantclass.herokuapp.com/api/login', data: user, method: 'POST'})
                .then(resp => {
                    const token = resp.data.token;
                    const type = resp.data.type[0].name;
                    console.log(type);
                    const user = {'u': resp.data.user.id, 't': resp.data.user.roles[0].name};
                    localStorage.setItem('token', token);
                    localStorage.setItem('user', JSON.stringify(user));

                    axios.defaults.headers.common['Authorization'] = token;
                    commit('auth_success', token, user);
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    reject(err)
                })
        })
    },

    async loginGithub({commit}) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios.get('https://instantclass.herokuapp.com/api/authorize/github')
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async loginGithubCallback({commit}, payload) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios.get('https://instantclass.herokuapp.com/api/authorize/github/callback', {
                params:payload
            })
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },


    async register({commit}, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios({url: 'https://instantclass.herokuapp.com/api/register/', data: user, method: 'POST'})
                .then(resp => {
                    const token = resp.data.token;
                    const user = {'u': resp.data.user.id, 't': type};
                    localStorage.setItem('token', token);
                    localStorage.setItem('user', JSON.stringify(user));
                    axios.defaults.headers.common['Authorization'] = token;
                    commit('auth_success', token, user);
                    resolve(resp);
                })
                .catch(err => {
                    commit('auth_error', err);
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    reject(err)
                })
        })
    },

    async logout({commit}) {
        return new Promise((resolve, reject) => {
            commit('logout');
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            delete axios.defaults.headers.common['Authorization'];
            resolve()
        })
    }
};

const mutations = {
    auth_request(state) {
        state.status = true
    },
    auth_success(state, token, user) {
        state.status = false;
        state.token = token;
        state.user = user
    },
    auth_error(state) {
        state.status = false
    },
    logout(state) {
        state.status = '';
        state.token = '';
    },
};

export default {
    state,
    getters,
    actions,
    mutations
}
