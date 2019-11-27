import Home from "./pages/Home";
import Tests from "./pages/Tests";
import Login from "./pages/Login";
import Register from "./pages/Register";
import NotFound from "./pages/NotFound";
import VueRouter from "vue-router";
import store from "./store";

const router = new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/",
            component: Home,
            name: "home"
        },

        {
            path: "/#",
            component: Home,
            name: "#"
        },

        {
            path: "/test/:drivingLicenseType",
            component: Tests,
            name: "tests"
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
            component: Login, // Will be changed to Dashboard when we have a page
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
            path: "*",
            component: NotFound,
            name: "notFound"
        }
    ]
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
