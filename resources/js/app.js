import Vue from "vue";
import VueRouter from "vue-router";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import router from "./routes";
import VueCountdown from "@chenfengyuan/vue-countdown";
import AxiosPlugin from "./plugins/axios";
import store from "./store";

// Components
import Header from "./components/Header";
import Footer from "./components/Footer";
import App from "./pages/App";
import Card from "./components/Card";
import Nav from "./components/Nav";
import Bar from "./components/Bar";
import BarDropdown from "./components/BarDropdown";
import LineChart from "./components/LineChart";
import PulseLoader from "vue-spinner/src/PulseLoader";

// Font Awesome
import "./font-awesome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

Vue.component("fa-icon", FontAwesomeIcon);

Vue.component(Header.name, Header);
Vue.component(Footer.name, Footer);
Vue.component("testly-" + App.name, App);
Vue.component("theory-" + Card.name, Card);
Vue.component("theory-" + Nav.name, Nav);
Vue.component("theory-" + Bar.name, Bar);
Vue.component("theory-" + BarDropdown.name, BarDropdown);
Vue.component("theory-" + "pulse-loader", PulseLoader);
Vue.component("theory-" + LineChart.name, LineChart);

Vue.component("theory-" + VueCountdown.name, VueCountdown);

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
    bodyClassName: ["notification-center"]
};

Vue.use(AxiosPlugin);
Vue.use(VueRouter);
Vue.use(Toast, options);

Vue.config.productionTip = false;

const app = new Vue({
    el: "#app",
    router: router,
    store
});
