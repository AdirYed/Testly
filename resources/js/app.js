import Vue from "vue";
import VueRouter from "vue-router";
import { routes } from "./routes";

Vue.use(VueRouter);

// Components
import Card from "./components/Card";
import Nav from "./components/Nav";
import Bar from "./components/Bar";

Vue.component("theory-card", Card);
Vue.component("theory-nav-bar", Nav);
Vue.component("theory-bar", Bar);

const app = new Vue({
    el: "#app",

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

function smoothScroll(target, duration) {
    const scrollTo = document.querySelector(target);
    const targetPosition = scrollTo.getBoundingClientRect().top - 58; // minus the nav which is 60px and also his box-shadow which is 1px, 60-1-1=59, another -1 to be 100% sure.
    const startPosition = window.pageYOffset;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, targetPosition, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

const btnScrollAble = document.getElementById("home-scroll-able");

btnScrollAble.addEventListener("click", function() {
    smoothScroll("#home-body", 500);
});
