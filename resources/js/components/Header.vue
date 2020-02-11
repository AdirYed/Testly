<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <!-- Logo -->
            <theory-bar
                to="home"
                class="tw-flex tw-items-center tw-px-4"
                style="height: var(--header-height)"
            >
                <div class="testly-icon tw-w-10 tw-h-10 tw-ml-1" />
                <div class="tw-text-xl tw-text-primary tw-font-semibold">
                    טסטלי
                </div>
            </theory-bar>

            <theory-bar-dropdown to="tests">
                <template slot="title">
                    <fa-icon icon="newspaper" />
                    מבחן
                </template>

                <router-link
                    class="inner-bar-dropdown tw-block tw-px-4 tw-py-2 tw-text-gray-800"
                    v-for="(test, index) in $store.state.drivingLicenseTypes"
                    :to="{
                        name: 'tests',
                        params: { drivingLicenseType: test.code }
                    }"
                    :key="index"
                >
                    <fa-icon class="fa-fw" :icon="test.icon" v-if="test.icon" />
                    {{ test.name }}
                    ({{ test.code }})
                </router-link>
            </theory-bar-dropdown>
        </template>
        <template slot="right-bar">
            <!--            <theory-bar to="#">-->
            <!--                <fa-icon icon="globe" />-->
            <!--                שפה-->
            <!--            </theory-bar>-->

            <theory-bar to="about-us">
                <fa-icon icon="info-circle" />
                אודות
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
                buttonTo="dashboard"
            >
                <template slot="title">
                    <fa-icon icon="user" />
                    {{
                        $store.state.user.first_name.length > 12
                            ? $store.state.user.first_name.substr(0, 12) + "..."
                            : $store.state.user.first_name
                    }}
                </template>

                <router-link
                    :to="{ name: 'dashboard' }"
                    class="inner-bar-dropdown tw-block tw-px-4 tw-py-2 tw-text-gray-800"
                >
                    <fa-icon class="fa-fw" icon="user" />
                    הפרופיל שלי
                </router-link>

                <div
                    class="inner-bar-dropdown tw-block tw-px-4 tw-py-2 tw-text-gray-800"
                    @click="logout"
                    v-if="$store.getters.isLoggedIn"
                >
                    <fa-icon class="fa-fw" icon="sign-out-alt" />
                    התנתק
                </div>
            </theory-bar-dropdown>
        </template>
    </theory-nav-bar>
</template>

<script>
import Nav from "./Nav";
import BarDropdown from "./BarDropdown";
import Bar from "./Bar";

export default {
    name: "testly-header",

    components: {
        "theory-nav-bar": Nav,
        "theory-bar": Bar,
        "theory-bar-dropdown": BarDropdown
    },

    methods: {
        logout() {
            this.$store.dispatch("logout");

            if (this.$route.meta.authOnly) {
                this.$router.push({ name: "home" });
            }
        }
    },

    created() {
        this.$store.dispatch("fetchDrivingLicenseTypes");
    }
};
</script>

<style scoped>
@media (hover: hover) and (pointer: fine) {
    .inner-bar-dropdown:hover {
        @apply bg-primary text-white cursor-pointer;
    }
}

.inner-bar-dropdown:active {
    @apply bg-primary text-white;
}
</style>
