import Vue from 'vue';
import VueRouter from 'vue-router';
import Card from './components/Card';
import {routes} from './routes';

Vue.use(VueRouter);

Vue.component('theory-card', Card);

const app = new Vue({
   el: '#app',

    router: new VueRouter(routes),
});
