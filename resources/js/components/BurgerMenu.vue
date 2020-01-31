<template>
    <div
        class="md:tw-hidden tw-w-full tw-h-full tw-flex tw-justify-center tw-content-center"
        style="margin-left: 30px"
    >
        <div
            class="tw-flex tw-h-full tw-my-auto tw-items-center"
            @click="toggleBurger"
        >
            <svg width="30" height="30">
                <rect width="28" height="2" x="0" y="4" />
                <rect width="28" height="2" x="0" y="14" />
                <rect width="28" height="2" x="0" y="24" />
            </svg>
        </div>

        <router-link
            :to="{ name: 'home' }"
            class="tw-flex tw-items-center tw-m-auto tw-h-full"
        >
            <div class="testly-icon tw-w-8 tw-h-8 tw-ml-1" />
            <div class="tw-text-xl tw-text-primary tw-font-semibold">
                טסטלי
            </div>
        </router-link>

        <transition name="fade">
            <div v-if="isActive" class="menu tw-text-center">
                <div
                    class="tw-flex tw-content-center tw-px-3"
                    style="height: var(--header-height)"
                >
                    <div
                        class="tw-flex tw-h-full tw-my-auto tw-items-center"
                        @click="toggleBurger"
                    >
                        <svg width="30" height="30">
                            <line
                                style="stroke:rgb(0, 0, 0); stroke-width: 2"
                                x1="4"
                                x2="24"
                                y1="4"
                                y2="26"
                            />
                            <line
                                style="stroke:rgb(0, 0, 0); stroke-width: 2"
                                x1="4"
                                x2="24"
                                y1="26"
                                y2="4"
                            />
                        </svg>
                    </div>
                </div>

                <div class="burger-wrapper tw-flex tw-flex-col">
                    <ul
                        class="tw-my-auto tw-flex tw-flex-col tw-justify-center"
                    >
                        <burger-bar to="home">
                            <span @click="toggleBurger">
                                דף הבית
                            </span>
                        </burger-bar>

                        <burger-bar to="home" toHash="#choose-a-test">
                            <span @click="toggleBurger">
                                מבחנים
                            </span>
                        </burger-bar>

                        <burger-bar to="about-us">
                            <span @click="toggleBurger">
                                אודות
                            </span>
                        </burger-bar>

                        <burger-bar
                            v-if="!$store.getters.isLoggedIn"
                            to="login"
                        >
                            <span @click="toggleBurger">
                                התחבר
                            </span>
                        </burger-bar>

                        <burger-bar
                            v-if="!$store.getters.isLoggedIn"
                            to="register"
                        >
                            <span @click="toggleBurger">
                                הירשם
                            </span>
                        </burger-bar>

                        <burger-bar
                            v-if="$store.getters.isLoggedIn"
                            to="register"
                        >
                            <span @click="toggleBurger">
                                הפרופיל שלי
                            </span>
                        </burger-bar>

                        <burger-bar v-if="$store.getters.isLoggedIn">
                            <span @click="logout">
                                התנתק
                            </span>
                        </burger-bar>
                    </ul>
                </div>
            </div>
        </transition>

        <transition name="fade-bg">
            <div v-if="isActive" class="menu-bg"></div>
        </transition>
    </div>
</template>

<script>
import BurgerBar from "./BurgerBar";

export default {
    name: "burger-menu",

    components: {
        BurgerBar
    },

    data() {
        return {
            isActive: false
        };
    },

    methods: {
        toggleBurger() {
            this.isActive = !this.isActive;

            if (!this.isActive) {
                document.body.style.overflow = "visible";
            } else {
                document.body.style.overflow = "hidden";
            }
        },

        logout() {
            this.toggleBurger();

            this.$store.dispatch("logout");

            if (this.$route.meta.authOnly) {
                this.$router.push({ name: "home" });
            }
        }
    },

    created() {
        const handleEscape = e => {
            if (e.key === "Esc" || e.key === "Escape") {
                if (this.isActive) {
                    this.toggleBurger();
                }
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    }
};
</script>

<style scoped>
.menu {
    @apply h-screen w-screen absolute left-0 top-0;

    background: radial-gradient(
            circle at 1% 1%,
            rgba(var(--primary-color-rgb), 0.95),
            rgba(220, 155, 0, 0.95)
        )
        no-repeat 50%;
    font-family: Open Sans, Helvetica, Arial, sans-serif;
    z-index: 1000;
}

.menu-bg {
    @apply h-screen w-screen absolute left-0 top-0;

    background: rgba(0, 0, 0, 0.25);
    z-index: 999;
}

.fade-enter-active {
    transition: opacity 0.2s linear;
}

.fade-leave-active {
    transition: opacity 0.15s linear;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.fade-bg-enter-active {
    transition: opacity 0.15s linear;
}

.fade-bg-enter,
.fade-leave-to {
    opacity: 0;
}

.burger-wrapper {
    height: calc(100% - var(--header-height) * 2);
}
</style>
