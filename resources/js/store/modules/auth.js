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
            axios({url: '/login', data: user, method: 'POST'})
                .then(resp => {
                    console.log(resp.data)
                    const token = resp.data.token;
                    const user = {
                        'u': resp.data.user.id,
                        't': resp.data.user.roles[0].name, //name of user role
                        'first_name': resp.data.user.first_name,
                        'speciment': resp.data.user.speciment
                    };
                    localStorage.setItem('token', token);
                    localStorage.setItem('user', JSON.stringify(user));
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
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

    async socialStudentAuth({commit}, provider) {
        commit('auth_request');
        return new Promise((resolve, reject) => {
            axios.get(`/authorize/${provider}`)
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async googleCallback({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/authorize/google/callback`, {
                params: payload
            })
                .then(resp => {
                    console.log(resp);
                    const token = resp.data.token;
                    const user = {
                        'u': resp.data.user.id,
                        't': "student",
                        'first_name': resp.data.user.first_name,
                        'speciment': resp.data.user.speciment
                    };
                    localStorage.setItem('token', token);
                    localStorage.setItem('user', JSON.stringify(user));
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async facebookCallback({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`/authorize/facebook/callback`, {
                params: payload
            })
                .then(resp => {
                    console.log(resp);
                    const token = resp.data.token;
                    const user = {
                        'u': resp.data.user.id,
                        't': "student",
                        'first_name': resp.data.user.first_name,
                        'speciment': resp.data.user.speciment
                    };
                    localStorage.setItem('token', token);
                    localStorage.setItem('user', JSON.stringify(user));
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
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
            axios({url: '/register', data: user, method: 'POST'})
                .then(resp => {
                    console.log(resp);
                    // const token = resp.data.token;
                    // const user = {
                    //     'u': resp.data.user.id,
                    //     't': resp.data.user.roles[0].name,
                    //     'first_name': resp.data.user.first_name
                    // };
                    // localStorage.setItem('token', token);
                    // localStorage.setItem('user', JSON.stringify(user));
                    // axios.defaults.headers.common['Authorization'] = token;
                    commit('auth_success', '', '');
                    resolve(resp);
                })
                .catch(err => {
                    console.log(err.response);
                    commit('auth_error', err);
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    reject(err)
                })
        })
    },

    async logout({commit}) {
        return new Promise((resolve, reject) => {
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
