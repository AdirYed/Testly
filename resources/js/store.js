import Vue from "vue";
import Vuex from "vuex";
import { axiosInstance } from "./plugins/axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: localStorage.getItem("user")
            ? JSON.parse(localStorage.getItem("user"))
            : null,
        token: localStorage.getItem("token") || null
    },

    getters: {
        isLoggedIn(state) {
            return typeof state.token === "string";
        }
    },

    mutations: {
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("user", JSON.stringify(user));
        },

        setToken(state, token) {
            state.token = token;
            localStorage.setItem("token", token);
        },

        removeUser(state) {
            state.user = null;
            localStorage.removeItem("user");
        },

        removeToken(state) {
            state.token = null;
            localStorage.removeItem("token");
        }
    },

    actions: {
        login({ commit }, credentials) {
            return axiosInstance
                .post("/auth/login", credentials)
                .then(response => {
                    commit("setUser", response.data.user);
                    commit("setToken", response.data.token);
                });
        },

        logout({ commit }) {
            axiosInstance.post("/auth/logout").then(() => {
                commit("removeUser");
                commit("removeToken");
            });
        },

        register({ commit }, credentials) {
            return axiosInstance
                .post("/auth/register", credentials)
                .then(response => {
                    commit("setUser", response.data.user);
                    commit("setToken", response.data.token);
                });
        }
    }
});
