<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            איפוס סיסמה
        </div>

        <template v-if="!isInvalidToken">
            <div
                class="tw-w-full tw-max-w-2xl tw-text-lg tw-pt-5 tw-text-center tw-mx-auto"
            >
                כדי לאפס את הסיסמה, נא הקלד סיסמה חדשה וחזקה.
            </div>

            <div class="tw-w-full tw-max-w-xs tw-mx-auto">
                <form
                    class="tw-rounded tw-px-8 tw-pt-5"
                    method="post"
                    @submit.prevent="forgotPassword"
                >
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
                            maxlength="255"
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

                    <div class="tw-mb-5">
                        <label
                            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                            for="password_confirmation"
                        >
                            אישור סיסמה
                        </label>
                        <input
                            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                            maxlength="255"
                            id="password_confirmation"
                            type="password"
                            placeholder="סיסמה"
                            v-model="auth.password_confirmation"
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
                            />
                        </div>

                        <p
                            v-else-if="errors.token"
                            class="tw-font-semibold tw-text-red-500 tw-text-xs"
                        >
                            תוקף איפוס הסיסמה פג או שאינו קיים במערכת.
                        </p>

                        <p
                            v-else-if="errors === 'token'"
                            class="tw-font-semibold tw-text-red-500 tw-text-xs"
                        >
                            תוקף איפוס הסיסמה פג.
                        </p>
                    </div>

                    <div class="tw-flex tw-flex-wrap tw-flex-col">
                        <button
                            class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                            type="submit"
                        >
                            איפוס סיסמה
                        </button>
                    </div>
                </form>
            </div>
        </template>

        <div
            v-else-if="!this.isInvalidTokenLoading && isInvalidToken"
            class="tw-pt-5 tw-text-xl"
        >
            <template v-if="errors.token">
                קישור זה אינו קיים במערכת.
            </template>

            <template v-else-if="errors === 'token'">
                תוקף איפוס הסיסמה פג, במידה והינך צריך לאפס את הסיסמה,
                <router-link :to="{ name: 'forgot-password' }" class="link">
                    בקש</router-link
                >
                קישור חדש.
            </template>

            <template v-else>
                תוקף איפוס הסיסמה פג או שקישור זה אינו קיים במערכת.
            </template>
        </div>

        <div class="tw-container tw-mx-auto tw-flex tw-justify-center" v-else>
            <theory-pulse-loader
                class="tw-absolute"
                style="top: 50%;"
                :loading="isInvalidTokenLoading"
                color="var(--primary-color)"
                size="40px"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "forgot-password",

    data() {
        return {
            auth: {
                token: "",
                password: "",
                password_confirmation: ""
            },

            isLoading: false,

            errors: {},

            isInvalidTokenLoading: true,
            isInvalidToken: true
        };
    },

    methods: {
        deleteError(property) {
            this.errors[property] = null;
        },

        forgotPassword() {
            this.isLoading = true;

            this.$axios
                .post("forgot-password/reset", this.auth)
                .then(() => {
                    alert("הסיסמה שונתה בהצלחה.");
                    this.$router.replace("login");
                })
                .catch(err => {
                    if (
                        err.response.status === 422 &&
                        err.response.data.errors
                    ) {
                        this.errors = err.response.data.errors;
                    }

                    this.isLoading = false;
                });
        }
    },

    created() {
        this.auth.token = this.$route.query.token;

        this.$axios
            .post("forgot-password/check-token", { token: this.auth.token })
            .then(() => {
                this.isInvalidTokenLoading = false;
                this.isInvalidToken = false;
            })
            .catch(err => {
                if (err.response.status === 422 && err.response.data.errors) {
                    this.errors = err.response.data.errors;
                }

                this.isInvalidTokenLoading = false;
            });
    }
};
</script>
