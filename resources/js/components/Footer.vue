<template>
    <div class="footer-wrap tw-truncate">
        <footer
            class="tw-container tw-px-10 md:tw-px-48 lg:tw-px-80 tw-mt-5 tw-m-auto tw-text-center"
        >
            <div class="md:tw-flex md:tw-justify-center">
                <div
                    class="tw-text-xl tw-font-bold md:tw-font-semibold tw-px-4"
                >
                    <router-link
                        class="tw-text-transparent-60 hover:tw-text-transparent-60"
                        :to="{ name: 'home' }"
                    >
                        דף הבית
                    </router-link>
                </div>
                <div
                    class="tw-text-xl tw-font-bold md:tw-font-semibold tw-px-4"
                >
                    <router-link
                        class="tw-text-transparent-60 hover:tw-text-transparent-60"
                        :to="{ name: 'home', hash: '#choose-a-test' }"
                    >
                        מבחני תאוריה
                    </router-link>
                </div>
                <div
                    class="tw-text-xl tw-font-bold md:tw-font-semibold tw-px-4"
                >
                    <router-link
                        class="tw-text-transparent-60 hover:tw-text-transparent-60"
                        :to="{ name: 'about-us' }"
                    >
                        אודות
                    </router-link>
                </div>
                <div
                    class="tw-text-xl tw-font-bold md:tw-font-semibold tw-px-4"
                >
                    <router-link
                        class="tw-text-transparent-60 hover:tw-text-transparent-60"
                        :to="{ name: 'contact-us' }"
                    >
                        צור קשר
                    </router-link>
                </div>
                <div
                    class="tw-text-xl tw-font-bold md:tw-font-semibold tw-px-4"
                >
                    <router-link
                        class="tw-text-transparent-60 hover:tw-text-transparent-60"
                        :to="{ name: 'privacy-policy' }"
                    >
                        תנאי שימוש
                    </router-link>
                </div>
            </div>

            <div
                class="tw-border-t tw-border-solid tw-border-transparent-50 tw-py-4 tw-mt-4 md:tw-mt-8"
            >
                <div
                    class="tw-text-transparent-60 tw-text-base md:tw-text-sm tw-text-center tw-font-semibold md:tw-font-bold"
                >
                    © טסטלי {{ new Date().getFullYear() }}. כל הזכויות שמורות.
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: "testly-footer"
};
</script>

<style scoped>
.footer-wrap {
    background: radial-gradient(
            circle at 1% 1%,
            var(--primary-color),
            rgb(220, 155, 0)
        )
        no-repeat 50%;
    background-size: auto;
}

.tw-text-transparent-60 {
    color: rgba(255, 255, 255, 0.6);
}

.hover\:tw-text-transparent-60:hover {
    color: white;
}

.tw-border-transparent-50 {
    border-color: rgba(255, 255, 255, 0.5);
}
</style>
