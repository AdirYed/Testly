import Home from "./pages/Home";
import Tests from "./pages/Tests";
import NotFound from "./pages/NotFound";

export const routes = {
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
            path: "/##",
            component: Home,
            name: "##"
        },

        {
            path: "/test/:drivingLicenseType",
            component: Tests,
            name: "tests"
        },

        {
            path: "*",
            component: NotFound,
            name: "notFound"
        }
    ]
};
