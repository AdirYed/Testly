import axios from "axios";
import store from "../store";

const axiosInstance = axios.create({
  baseURL: "/api"
});

axiosInstance.interceptors.request.use(
  config => {
    if (store.getters.isLoggedIn) {
      config.headers = config.headers || {};
      config.headers.Authorization = `Bearer ${store.state.token}`;
    }

    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

const axiosPlugin = {
  install(Vue) {
    Vue.prototype.$axios = axiosInstance;
  }
};

export default axiosPlugin;

export { axiosInstance };
