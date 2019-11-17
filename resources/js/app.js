import Vue from "vue";
import VueRouter from "vue-router";
import { routes } from "./routes";
import VueCountdown from "@chenfengyuan/vue-countdown";
import AxiosPlugin from "./plugins/axios";

// Components
import Card from "./components/Card";
import Nav from "./components/Nav";
import Bar from "./components/Bar";
import BarDropdown from "./components/BarDropdown";
import Header from "./components/Header";
import PulseLoader from "vue-spinner/src/PulseLoader";

// Font Awesome
import "./font-awesome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

Vue.component("fa-icon", FontAwesomeIcon);

Vue.component("theory-" + Card.name, Card);
Vue.component("theory-" + Nav.name, Nav);
Vue.component("theory-" + Bar.name, Bar);
Vue.component("theory-" + BarDropdown.name, BarDropdown);
Vue.component("theory-" + Header.name, Header);
Vue.component("theory-" + "pulse-loader", PulseLoader);

Vue.component("theory-" + VueCountdown.name, VueCountdown);

Vue.use(AxiosPlugin);
Vue.use(VueRouter);

Vue.config.productionTip = false;

const app = new Vue({
    el: "#app",
    router: new VueRouter(routes)
});
