import axios from 'axios'

const state = {
    status: '',
    token: localStorage.getItem('token') || null,
    user: JSON.parse(localStorage.getItem('user')) || null

};


const getters = {
    isLoggedIn: state => state.token,
    loggedInUser: state => state.user,
    authStatus: state => state.status,
};

const actions = {
    async login({commit}, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios({url: 'http://instantclass.ca/api/login', data: user, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    const token = resp.data.token;
                    const user = resp.data.user.id;
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
    async register({commit}, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios({url: 'http://127.0.0.1:8000/account/register/', data: user, method: 'POST'})
                .then(resp => {
                    const token = resp.data.token;
                    const user = resp.data.user.id;
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
        state.status = 'loading'
    },
    auth_success(state, token, user) {
        state.status = 'success';
        state.token = token;
        state.user = user
    },
    auth_error(state) {
        state.status = 'error'
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
