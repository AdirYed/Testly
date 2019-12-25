<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <theory-bar to="home">
                <fa-icon icon="home" />
                עמוד הבית
            </theory-bar>

            <theory-bar-dropdown to="tests" dusk="test">
                <template slot="title">
                    <fa-icon icon="newspaper" />
                    מבחן
                </template>

                <router-link
                    class="tw-block tw-px-4 tw-py-2 tw-text-gray-800 hover:tw-bg-primary hover:tw-text-white"
                    v-for="(test, index) in tests"
                    :to="{
                        name: 'tests',
                        params: { drivingLicenseType: test.code }
                    }"
                    :key="index"
                >
                    {{ test.name }}
                    ({{ test.code }})
                </router-link>
            </theory-bar-dropdown>
        </template>
        <template slot="right-bar">
            <theory-bar to="#">
                <fa-icon icon="globe" />
                שפה
            </theory-bar>

            <theory-bar to="login" v-if="!$store.getters.isLoggedIn">
                <fa-icon icon="sign-in-alt" />
                התחבר
            </theory-bar>

            <theory-bar to="register" v-if="!$store.getters.isLoggedIn">
                <fa-icon icon="sign-in-alt" />
                הירשם
            </theory-bar>

            <theory-bar-dropdown
                to="dashboard"
                v-if="$store.getters.isLoggedIn"
            >
                <template slot="title">
                    <fa-icon icon="user" />
                    {{ $store.state.user.first_name }}
                </template>

                <router-link
                    :to="{ name: 'dashboard' }"
                    class="tw-block tw-px-4 tw-py-2 tw-text-gray-800 hover:tw-bg-primary hover:tw-text-white tw-cursor-pointer"
                >
                    הפרופיל שלי
                </router-link>

                <div
                    class="tw-block tw-px-4 tw-py-2 tw-text-gray-800 hover:tw-bg-primary hover:tw-text-white tw-cursor-pointer"
                    @click="logout"
                    v-if="$store.getters.isLoggedIn"
                >
                    <fa-icon icon="sign-out-alt" />
                    התנתק
                </div>
            </theory-bar-dropdown>
        </template>
    </theory-nav-bar>
</template>

<script>
export default {
    name: "nav-header",

    data() {
        return {
            isOpen: false,

            tests: []
        };
    },

    created() {
        this.$axios.get(`/driving-license-types`).then(response => {
            this.tests = response.data;
        });

        const handleEscape = e => {
            if (e.key === "Esc" || e.key === "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    },

    methods: {
        logout() {
            this.$store.dispatch("logout");

            if (this.$router.currentRoute.path !== "/") {
                this.$router.push({ name: "home" });
            }
        }
    }
};
</script>
