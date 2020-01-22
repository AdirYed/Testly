<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div
            class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center tw-mb-5"
        >
            התחבר
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto">
            <form
                class="tw-rounded tw-px-8"
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
                        class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        :class="{ 'tw-border-red-500': errors.email }"
                        maxLength="50"
                        id="email"
                        type="email"
                        placeholder="אימייל"
                        v-model="auth.email"
                        @input="deleteError('email')"
                    />

                    <div
                        v-if="errors.email"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.email[0] }}
                    </div>
                </div>

                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="password"
                    >
                        סיסמה
                    </label>
                    <input
                        class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        :class="{ 'tw-border-red-500': errors.password }"
                        maxLength="255"
                        id="password"
                        type="password"
                        placeholder="סיסמה"
                        v-model="auth.password"
                        @input="deleteError('password')"
                    />

                    <div
                        v-if="errors.password"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.password[0] }}
                    </div>
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
                        />
                    </div>

                    <p
                        v-else-if="errors.general"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs"
                    >
                        {{ errors.general[0] }}
                    </p>

                    <p
                        v-else-if="verification.isVerified"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs"
                    >
                        משתמש זה עוד לא אומת.
                        <a
                            class="link tw-cursor-pointer"
                            @click="resendVerification"
                            >שלח</a
                        >
                        אימות חדש.
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
            auth: {
                email: "matan.yed@gmail.com",
                password: "secret"
            },

            isLoading: false,

            errors: {},

            verification: {
                isVerified: false,
                token: null
            },

            verificationNotification: false
        };
    },

    methods: {
        login() {
            this.isLoading = true;

            this.$store
                .dispatch("login", this.auth)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: "home" });
                })
                .catch(err => {
                    if (
                        err.response.status === 422 &&
                        err.response.data.error === "verification"
                    ) {
                        this.verification.isVerified = true;
                        this.verification.token = err.response.data.token;
                    }

                    if (
                        err.response.status === 422 &&
                        err.response.data.errors
                    ) {
                        this.errors = err.response.data.errors;
                    }

                    this.isLoading = false;
                });
        },

        deleteError(property) {
            this.errors[property] = null;

            if (property === "email") {
                this.verification = {
                    isVerified: false,
                    token: null
                };
            }
        },

        resendVerification() {
            if (this.verificationNotification) {
                return this.$toast.error("אימות נשלח כבר לאימייל.");
            }

            this.$axios
                .post(
                    "/resend-verification",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.verification.token}`
                        }
                    }
                )
                .then(() => {
                    this.$toast(
                        "נא לאמת את המשתמש באמצעות הקישור שנשלח לאימייל."
                    );
                })
                .catch(err => {
                    if (err.response.data.verified) {
                        this.$toast.error("משתמש זה כבר אומת.");
                    }
                });

            this.verificationNotification = true;
        }
    },

    created() {
        if (this.$route.query.verified === "1") {
            this.$router.replace("login");
            this.$toast.success("משתמש זה אומת.");
        }
    }
};
</script>
