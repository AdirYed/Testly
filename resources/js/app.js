import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';

Vue.use(VueRouter);

// Components
import Card from './components/Card';
import Nav from './components/Nav';
import Bar from './components/Bar';

Vue.component('theory-card', Card);
Vue.component('theory-nav-bar', Nav);
Vue.component('theory-bar', Bar);

const app = new Vue({
   el: '#app',

    router: new VueRouter(routes),
});
