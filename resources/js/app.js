import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes';
import VueCountdown from '@chenfengyuan/vue-countdown';

// Components
import Card from './components/Card';
import Nav from './components/Nav';
import Bar from './components/Bar';
import Header from './components/Header';
import Moonloader from 'vue-spinner/src/Moonloader';

// Font Awesome
import './font-awesome';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

Vue.component('fa-icon', FontAwesomeIcon);

Vue.component('theory-' + Card.name, Card);
Vue.component('theory-' + Nav.name, Nav);
Vue.component('theory-' + Bar.name, Bar);
Vue.component('theory-' + Header.name, Header);
Vue.component('theory-' + 'dot-loader', Moonloader);

Vue.component('theory-' + VueCountdown.name, VueCountdown);

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
