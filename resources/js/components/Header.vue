<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <theory-bar to="home">
                <fa-icon icon="home" />
                עמוד הבית
            </theory-bar>

            <theory-bar-dropdown to="tests">
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
            <theory-bar to="login" v-if="!user">
                <fa-icon icon="sign-in-alt" />
                הירשם / התחבר
            </theory-bar>
            <theory-bar @click.native="logout" v-if="user">
                <fa-icon icon="sign-in-alt" />
                התנתק
            </theory-bar>
            <theory-bar v-if="user">
                <fa-icon icon="sign-in-alt" />
                ברוכים הבאים
                {{ user.first_name }}
            </theory-bar>

            <theory-bar to="#">
                <fa-icon icon="globe" />
                שפה
            </theory-bar>
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
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            this.$router.push({ name: "home" });
        }
    },
    computed: {
        user() {
            const userJson = localStorage.getItem("user");

            return userJson ? JSON.parse(userJson) : null;
        }
    }
};
</script>
