import i18n from '../../src/i18n';
const LANGUAGE_KEY = 'app_language';

const state = {
    language: 'fr',
};

const getters = {
};

const actions = {
    async initLanguage({commit}) {
        commit('loadLanguage');
    },
};

const mutations = {
    /**
     * Method to save the language upon selecting it.
     *
     * @param {object} state - vuex state of current store scope.
     * @param {*} payload - contains mixed values necessary inside the method.
     *
     * @return {void}
     */
    saveLanguage(state, payload) {
        console.log('payload');
        console.log(payload);
        state.language = payload;
        i18n.locale = payload;
        localStorage.setItem(LANGUAGE_KEY, payload);
    },
    /**
     * Method to load the language upon site initialization.
     *
     * @param {object} state - vuex state of current store scope.
     *
     * @return {void}
     */
    loadLanguage(state) {
        console.log('loadlanguage');
        const lang = localStorage.getItem(LANGUAGE_KEY);
        console.log(lang);
        if (!_.isNil(lang)) {
            i18n.locale = lang;
            state.language = lang;
        } else {
            i18n.locale = 'fr';
            state.language = 'fr'
        }
    },
};

export default {
    state,
    getters,
    actions,
    mutations
}