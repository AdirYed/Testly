import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './routes';

// Components
import Card from './components/Card';
import Nav from './components/Nav';
import Bar from './components/Bar';
import Header from './components/Header';

// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faChevronRight } from '@fortawesome/free-solid-svg-icons';
import { faChevronLeft } from '@fortawesome/free-solid-svg-icons';
import { faHome } from '@fortawesome/free-solid-svg-icons';
import { faNewspaper } from '@fortawesome/free-solid-svg-icons';
import { faSignInAlt } from '@fortawesome/free-solid-svg-icons';
import { faGlobe } from '@fortawesome/free-solid-svg-icons';
import { faAngleDoubleDown } from '@fortawesome/free-solid-svg-icons';

Vue.component('fa-icon', FontAwesomeIcon);

library.add(faChevronRight);
library.add(faChevronLeft);
library.add(faHome);
library.add(faNewspaper);
library.add(faSignInAlt);
library.add(faGlobe);
library.add(faAngleDoubleDown);

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
