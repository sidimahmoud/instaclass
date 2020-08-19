import axios from 'axios'

const state = {
    teachers: [],
    students: [],
    admins: [],


};
const getters = {
    allTeachers: (state) => state.teachers,
    allStudents: (state) => state.students,
};

const actions = {
    async fetchTeachers({commit}) {
        const response = await axios.get('https://instantclass.herokuapp.com/api/teachers');
        commit('setTeachers', response.data);
    },
    async fetchStudents({commit}) {
        const response = await axios.get('https://instantclass.herokuapp.com/api/students');
        commit('setStudents', response.data);
    },
};
const mutations = {
    setTeachers: (state, payload) => (state.teachers = payload),
    setStudents: (state, payload) => (state.students = payload),
};
export default {
    state,
    getters,
    actions,
    mutations
}
