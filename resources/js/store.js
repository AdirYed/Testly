import Vue from "vue";
import Vuex from "vuex";
import { axiosInstance } from "./plugins/axios";
import { formatDate } from "./plugins/formatDate";
import router from "./routes";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: localStorage.getItem("user")
      ? JSON.parse(localStorage.getItem("user"))
      : null,
    token: localStorage.getItem("token") || null,
    savedTestReport: localStorage.getItem("savedTestReport")
      ? JSON.parse(localStorage.getItem("savedTestReport"))
      : null,
    drivingLicenseTypes: null,
  },

  getters: {
    isTokenCorrect(state) {
      return typeof state.token === "string";
    },

    isLoggedIn(state, getters) {
      return getters.isTokenCorrect && state.user;
    },

    isGuestLoggedIn(state, getters) {
      return getters.isTokenCorrect && !state.user;
    },
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
    },

    saveTestReport(state, payload) {
      state.savedTestReport = payload;
      localStorage.setItem("savedTestReport", JSON.stringify(payload));
    },

    deleteSavedTestReport(state) {
      state.savedTestReport = null;
      localStorage.removeItem("savedTestReport");
    },
  },

  actions: {
    auth({ dispatch, commit, getters }) {
      if (!getters.isTokenCorrect) {
        return;
      }

      return axiosInstance
        .get("/me")
        .then((response) => {
          dispatch("storeSavedTestReportIfExists");

          if (!response.data.user.email) {
            if (router.currentRoute.meta.authOnly) {
              router.push({ name: "home" });
            }

            commit("removeUser");
            return;
          }

          if (router.currentRoute.meta.guestOnly) {
            router.push({ name: "home" });
          }

          commit("setUser", response.data.user);
        })
        .catch((err) => {
          if (
            err.response &&
            err.response.status &&
            err.response.status === 401
          ) {
            commit("removeUser");
            commit("removeToken");
            dispatch("guestRegister");
          }
        });
    },

    login({ dispatch, commit }, credentials) {
      return axiosInstance.post("/auth/login", credentials).then((response) => {
        commit("setUser", response.data.user);
        commit("setToken", response.data.token);
        return dispatch("storeSavedTestReportIfExists");
      });
    },

    logout({ commit }) {
      commit("removeUser");
      commit("removeToken");
    },

    register({}, credentials) {
      return axiosInstance.post("/auth/register", credentials);
    },

    guestRegister({ commit }) {
      return axiosInstance.post("/auth/guest").then((response) => {
        commit("setToken", response.data);
      });
    },

    fetchTestReports() {
      return axiosInstance.get("/test-reports");
    },

    storeTestReport({ getters, commit }, payload) {
      payload.started_at = formatDate(payload.started_at);
      payload.finished_at = formatDate(payload.finished_at);

      if (!getters.isTokenCorrect) {
        commit("saveTestReport", payload);
        return;
      }

      return axiosInstance.post("/test-reports", payload);
    },

    storeSavedTestReportIfExists({ state, getters, commit }) {
      if (
        !getters.isTokenCorrect ||
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
    },

    fetchDrivingLicenseTypes({ state }) {
      return axiosInstance.get(`/driving-license-types`).then((response) => {
        state.drivingLicenseTypes = response.data;
      });
    },
  },
});
