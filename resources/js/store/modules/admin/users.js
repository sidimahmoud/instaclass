import axios from 'axios'

const state = {
    teachers: [],
    students: [],
    admins: [],
    banned: [],
    counts:'',
    fetchingUsers: false
};
const getters = {
    allTeachers: (state) => state.teachers,
    allStudents: (state) => state.students,
    allAdmins: (state) => state.admins,
    allBanned: (state) => state.banned,
    allCounts: (state) => state.counts,
    fetchingUsers: (state) => state.fetchingUsers,
};

const actions = {
    async fetchTeachers({commit}) {
        headers();
        const response = await axios.get('/teachers');
        commit('setTeachers', response.data);
        commit("setFetchingUsers", false);
    },
    async fetchBanned({commit}) {
        commit("setFetchingUsers", true);
        headers();
        const response = await axios.get('/banned');
        commit('setBanned', response.data);
        commit("setFetchingUsers", false);
    },
    async fetchStudents({commit}) {
        commit("setFetchingUsers", true);
        headers();
        const response = await axios.get('/students');
        commit('setStudents', response.data);
        commit("setFetchingUsers", false);

    },
    async fetchAdmins({commit}) {
        commit("setFetchingUsers", true);
        headers();
        const response = await axios.get('/admins');
        commit('setAdmins', response.data);
        commit("setFetchingUsers", false);

    },
    async loadCounts({commit}) {
        commit("setFetchingUsers", true);
        headers();
        const response = await axios.get('/counts')
        commit("setCounts", response.data);
        commit("setFetchingUsers", false);

    },
};
const mutations = {
    setTeachers: (state, payload) => (state.teachers = payload),
    setStudents: (state, payload) => (state.students = payload),
    setAdmins: (state, payload) => (state.admins = payload),
    setBanned: (state, payload) => (state.banned = payload),
    setCounts: (state, payload) => (state.counts = payload),
    setFetchingUsers: (state, val) => (state.fetchingUsers = val),
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
