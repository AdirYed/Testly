import axios from "axios";

const axiosInstance = axios.create({
    baseURL: "/api"
});

axiosInstance.interceptors.request.use(
    config => {
        const token = window.localStorage.getItem("token");

        if (token) {
            config.headers = config.headers || {};
            config.headers.Authorization = `Bearer ${token}`;
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
