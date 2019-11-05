import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes';

// Components
import Card from './components/Card';
import Nav from './components/Nav';
import Bar from './components/Bar';
import Header from './components/Header';

// Font Awesome
import './font-awesome';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

Vue.component('fa-icon', FontAwesomeIcon);

Vue.component('theory-card', Card);
Vue.component('theory-nav-bar', Nav);
Vue.component('theory-bar', Bar);
Vue.component('theory-header', Header);

// routes
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});

// Use when you have a horizontal scroll
/*
var docWidth = document.documentElement.offsetWidth;

[].forEach.call(
    document.querySelectorAll('*'),
    function(el) {
        if (el.offsetWidth > docWidth) {
            console.log(el);
        }
    }
);
*/
