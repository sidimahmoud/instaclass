import axios from 'axios'

const state = {
    teachers: [],
    students: [],
    admins: [],


};
const getters = {
    allTeachers: (state) => state.teachers,
    allStudents: (state) => state.students,
    allAdmins: (state) => state.admins,
};

const actions = {
    async fetchTeachers({commit}) {
        headers();
        const response = await axios.get('https://instantclass.herokuapp.com/api/teachers');
        commit('setTeachers', response.data);
    },
    async fetchStudents({commit}) {
        headers();
        const response = await axios.get('https://instantclass.herokuapp.com/api/students');
        commit('setStudents', response.data);
    },
    async fetchAdmins({commit}) {
        headers();
        const response = await axios.get('https://instantclass.herokuapp.com/api/students');
        commit('setAdmins', response.data);
    },
};
const mutations = {
    setTeachers: (state, payload) => (state.teachers = payload),
    setStudents: (state, payload) => (state.students = payload),
    setAdmins: (state, payload) => (state.admins = payload),
};

function headers() {
    let token = localStorage.getItem('token') || '';
    if (token){
        axios.defaults.headers.common['Authorization'] = 'Bearer '+ token;
    }
}
export default {
    state,
    getters,
    actions,
    mutations
}
