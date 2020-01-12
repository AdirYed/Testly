import Home from "./pages/Home";
import Tests from "./pages/Tests";
import TestResult from "./pages/TestResult";
import Login from "./pages/Login";
import Dashboard from "./pages/Dashboard";
import Register from "./pages/Register";
import NotFound from "./pages/NotFound";
import VueRouter from "vue-router";
import store from "./store";
import AboutUs from "./pages/AboutUs";

const router = new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/",
            component: Home,
            name: "home"
        },

        {
            path: "/test/:drivingLicenseType",
            component: Tests,
            name: "tests"
        },

        {
            path: "/test/result/:uuid",
            component: TestResult,
            name: "test-result",
            meta: {
                authOnly: true
            }
        },

        {
            path: "/register",
            component: Register,
            name: "register",
            meta: {
                guestOnly: true
            }
        },

        {
            path: "/login",
            component: Login,
            name: "login",
            meta: {
                guestOnly: true
            }
        },

        {
            path: "/dashboard",
            component: Dashboard,
            name: "dashboard",
            meta: {
                authOnly: true
            }
        },

        {
            path: "/forgot-password",
            component: Home, // Will be changed to ForgotPassword when we have a page
            name: "forgot-password",
            meta: {
                guestOnly: true
            }
        },

        {
            path: "/about-us",
            component: AboutUs,
            name: "about-us"
        },

        {
            path: "*",
            component: NotFound,
            name: "not-found"
        }
    ],

    scrollBehavior(to) {
        if (to.hash) {
            return {
                selector: to.hash
            };
        }
    }
});

router.beforeEach((to, from, next) => {
    if (
        to.matched.some(record => record.meta.guestOnly) &&
        store.getters.isLoggedIn
    ) {
        next({ name: "home" });
        return;
    }

    if (
        to.matched.some(record => record.meta.authOnly) &&
        !store.getters.isLoggedIn
    ) {
        next({ name: "home" });
        return;
    }

    next();
});

export default router;
