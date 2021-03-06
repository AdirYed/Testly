import Vue from "vue";
import VueRouter from "vue-router";
import vueHeadful from "vue-headful";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import router from "./routes";
import AxiosPlugin from "./plugins/axios";
import store from "./store";
import VueAnalytics from "vue-analytics";
// Components
import App from "./pages/App";
import PulseLoader from "vue-spinner/src/PulseLoader";
// Font Awesome
import "./font-awesome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

Vue.component("vue-headful", vueHeadful);
Vue.component("fa-icon", FontAwesomeIcon);

Vue.component("testly-" + App.name, App);
Vue.component("theory-" + "pulse-loader", PulseLoader);

const options = {
  position: "bottom-right",
  maxToasts: 3,
  icon: false,
  timeout: 5000,
  closeOnClick: false,
  pauseOnFocusLoss: true,
  pauseOnHover: false,
  draggable: true,
  hideCloseButton: true,
  hideProgressBar: true,
  toastClassName: ["notification-toast"],
  bodyClassName: ["notification-body"],
};

Vue.use(AxiosPlugin);
Vue.use(VueRouter);
Vue.use(Toast, options);
Vue.use(VueAnalytics, {
  id: process.env.MIX_GOOGLE_ANALYTICS_ID,
  checkDuplicatedScript: true,
  router,
  autoTracking: {
    exception: true,
  },
});

Vue.config.productionTip = false;

if (store.getters.isTokenCorrect) {
  store.dispatch("auth");
}

if (!store.getters.isTokenCorrect) {
  store.dispatch("guestRegister");
}

const app = new Vue({
  el: "#app",
  router: router,
  store,
});
