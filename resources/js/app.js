import Vue from 'vue';
import VueRouter from 'vue-router';
import Card from './components/Card';
import Nav from './components/Nav';
import LeftBar from './components/LeftBar';
import RightBar from './components/RightBar';
import {routes} from './routes';

Vue.use(VueRouter);

Vue.component('theory-card', Card);
Vue.component('theory-nav-bar', Nav);
Vue.component('theory-left-bar', LeftBar);
Vue.component('theory-right-bar', RightBar);

const app = new Vue({
   el: '#app',

    router: new VueRouter(routes),
});
