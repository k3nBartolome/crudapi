import { createStore } from 'vuex'
import createPersistedState from "vuex-persistedstate"

export default createStore({
    plugins: [createPersistedState({
        storage: window.sessionStorage
    })],
    state: {
        user: null,
        token: null,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setToken(state, token) {
            state.token = token;
        },
        setLogout(state) {
            state.user = false;
            state.token = false;
        },
    },
    actions: {},
    getters: {
        isLoggedIn(state) {
            return !!state.token;
        },
    },
})