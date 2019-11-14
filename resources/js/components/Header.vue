<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <theory-bar to="home">
                <fa-icon icon="home" />
                עמוד הבית
            </theory-bar>

            <theory-bar class="tw-relative">
                <button
                    @mouseenter="isOpen = true"
                    @mouseleave="isOpen = false"
                    class="route lg:tw-p-4 tw-py-3 tw-px-0 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary lg:tw-mb-0 tw-mb-2"
                    :class="{
                        'tw-font-bold ': this.$route.name === 'tests',
                        'tw-border-primary':
                            isOpen || this.$route.name === 'tests'
                    }"
                >
                    <fa-icon icon="newspaper" />

                    מבחן
                </button>

                <!--                <button v-if="isOpen" @click="isOpen = false" class="tw-fixed tw-inset-0 tw-h-full tw-w-full tw-cursor-default tw-z-0"></button>-->

                <div
                    v-if="isOpen"
                    class="tw-absolute tw-right-0 tw-py-1 tw-w-48 tw-bg-white tw-rounded tw-border"
                    style="border-color: rgba(0, 0, 0, 0.25);"
                    @click="isOpen = false"
                    @mouseenter="isOpen = true"
                    @mouseleave="isOpen = false"
                >
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
                </div>
            </theory-bar>
        </template>

        <template slot="right-bar">
            <theory-bar to="#">
                <fa-icon icon="sign-in-alt" />
                הירשם / התחבר
            </theory-bar>

            <theory-bar to="##">
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

            tests: [
                {
                    code: "B",
                    name: "רכב פרטי"
                },

                {
                    code: "A",
                    name: "אופנוע"
                },

                {
                    code: "1",
                    name: "טרקטור"
                },

                {
                    code: "C1",
                    name: "רכב משא קל"
                },

                {
                    code: "C",
                    name: "רכב משא כבד"
                },

                {
                    code: "D",
                    name: "רכב ציבורי"
                },

                {
                    code: "A3",
                    name: "אופניים חשמליים"
                }
            ],

            prevRoute: "/"
        };
    },

    created() {
        const handleEscape = e => {
            if (e.key === "Esc" || e.key === "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    }
};
</script>
