<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            התחבר
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto">
            <form
                class="tw-rounded tw-px-8 tw-pt-6 tw-pb-8 tw-mb-5"
                method="post"
                @submit.prevent="login"
            >
                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="email"
                    >
                        אימייל
                    </label>
                    <input
                        class="login-input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        id="email"
                        type="email"
                        placeholder="אימייל"
                        v-model="payload.email"
                    />
                </div>

                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="password"
                    >
                        סיסמה
                    </label>
                    <input
                        class="login-input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        id="password"
                        type="password"
                        placeholder="סיסמה"
                        v-model="payload.password"
                    />
                </div>

                <div class="tw-my-3">
                    <div
                        class="tw-container tw-mx-auto tw-flex tw-justify-center"
                        style="height: 18px"
                        v-if="isLoading"
                    >
                        <theory-pulse-loader
                            class=""
                            :loading="isLoading"
                            color="var(--primary-color)"
                            size="0.75rem"
                        ></theory-pulse-loader>
                    </div>

                    <p
                        v-else-if="isInvalid"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs"
                    >
                        הפרטים שהזנת שגוים!
                    </p>
                </div>

                <div class="tw-flex tw-flex-wrap tw-flex-col">
                    <div class="tw-mb-5">
                        <router-link
                            class="link tw-text-sm tw-font-bold"
                            :to="{ name: 'forgot-password' }"
                        >
                            שכחת את הסיסמה?
                        </router-link>
                    </div>

                    <button
                        class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                        type="submit"
                    >
                        התחבר
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "login",

    data() {
        return {
            payload: {
                email: "",
                password: ""
            },

            isInvalid: false,

            isLoading: false
        };
    },

    methods: {
        login() {
            this.isLoading = true;

            this.$axios
                .post("/auth/login", this.payload)
                .then(response => {
                    window.localStorage.setItem("token", response.data.token);
                    window.localStorage.setItem(
                        "user",
                        JSON.stringify(response.data.user)
                    );

                    this.isLoading = false;

                    this.$router.push({ name: "home" });
                })
                .catch(() => {
                    this.isLoading = false;
                    this.isInvalid = true;
                });
        }
    }
};
</script>
