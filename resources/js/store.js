import Vue from "vue";
import Vuex from "vuex";
import { axiosInstance } from "./plugins/axios";
import { formatDate } from "./plugins/formatDate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: localStorage.getItem("user")
            ? JSON.parse(localStorage.getItem("user"))
            : null,
        token: localStorage.getItem("token") || null,
        savedTestReport: localStorage.getItem("savedTestReport")
            ? JSON.parse(localStorage.getItem("savedTestReport"))
            : null
    },

    getters: {
        isLoggedIn(state) {
            return typeof state.token === "string";
        }
    },

    mutations: {
        setUser(state, { user, token }) {
            state.user = user;
            state.token = token;
            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("token", token);
        },

        removeUser(state) {
            state.user = null;
            localStorage.removeItem("user");
        },

        removeToken(state) {
            state.token = null;
            localStorage.removeItem("token");
        },

        saveTestReport(state, payload) {
            state.savedTestReport = payload;
            localStorage.setItem("savedTestReport", JSON.stringify(payload));
        },

        deleteSavedTestReport(state) {
            state.savedTestReport = null;
            localStorage.removeItem("savedTestReport");
        }
    },

    actions: {
        login({ dispatch, commit }, credentials) {
            return axiosInstance
                .post("/auth/login", credentials)
                .then(response => {
                    commit("setUser", response.data);
                    return dispatch("storeSavedTestReportIfExists");
                });
        },

        logout({ commit }) {
            commit("removeUser");
            commit("removeToken");
        },

        register({ dispatch, commit }, credentials) {
            return axiosInstance.post("/auth/register", credentials);
        },

        fetchTestReports() {
            return axiosInstance.get("/test-reports");
        },

        storeTestReport({ getters, commit }, payload) {
            payload.started_at = formatDate(payload.started_at);
            payload.finished_at = formatDate(payload.finished_at);

            if (!getters.isLoggedIn) {
                commit("saveTestReport", payload);
                return;
            }

            return axiosInstance.post("/test-reports", payload);
        },

        storeSavedTestReportIfExists({ state, getters, commit }) {
            if (
                !getters.isLoggedIn ||
                typeof state.savedTestReport !== "object" ||
                state.savedTestReport === null
            ) {
                return;
            }

            return axiosInstance
                .post("/test-reports", state.savedTestReport)
                .then(() => {
                    commit("deleteSavedTestReport");
                });
        },

        fetchCategoryTypes() {
            return axiosInstance.get("categories");
        }
    }
});
