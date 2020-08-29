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
                    const user = {
                        'u': resp.data.user.id,
                        't': resp.data.user.roles[0].name,
                        'first_name': resp.data.user.first_name
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
        return new Promise((resolve, reject) => {
            axios.get(`https://instantclass.herokuapp.com/api/authorize/${provider}`)
                .then(resp => {
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error');
                    reject(err)
                })
        })
    },
    async socialStudentAuthCallback({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get(`https://instantclass.herokuapp.com/api/authorize/${payload.provider}/callback`, {
                params: payload
            })
                .then(resp => {
                    console.log(resp);
                    const token = resp.data.token;
                    const user = {
                        'u': resp.data.user.id,
                        't': resp.data.user.roles[0].name,
                        'first_name': resp.data.user.first_name
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

    // async loginGoogle({commit}) {
    //     return new Promise((resolve, reject) => {
    //         axios.get('https://instantclass.herokuapp.com/api/authorize/google')
    //             .then(resp => {
    //                 resolve(resp)
    //             })
    //             .catch(err => {
    //                 commit('auth_error');
    //                 reject(err)
    //             })
    //     })
    // },
    // async loginGoogleCallback({commit}, payload) {
    //     return new Promise((resolve, reject) => {
    //         axios.get('https://instantclass.herokuapp.com/api/authorize/google/callback', {
    //             params: payload
    //         })
    //             .then(resp => {
    //                 const token = resp.data.token;
    //                 const user = {'u': resp.data.user.id, 't': "student"}; //resp.data.user.roles[0].name
    //                 localStorage.setItem('token', token);
    //                 localStorage.setItem('user', JSON.stringify(user));
    //
    //                 axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    //                 resolve(resp)
    //             })
    //             .catch(err => {
    //                 commit('auth_error');
    //                 reject(err)
    //             })
    //     })
    // },


    async register({commit}, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request');
            axios({url: 'https://instantclass.herokuapp.com/api/register/', data: user, method: 'POST'})
                .then(resp => {
                    const token = resp.data.token;
                    const user = {
                        'u': resp.data.user.id,
                        't': resp.data.user.roles[0].name,
                        'first_name': resp.data.user.first_name
                    };
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
