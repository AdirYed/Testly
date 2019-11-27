<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            הירשם
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto">
            <form
                class="tw-rounded tw-px-8 tw-pt-6 tw-pb-8 tw-mb-5"
                method="post"
                @submit.prevent="register"
            >
                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="first_name"
                    >
                        שם פרטי
                    </label>
                    <input
                        class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        :class="{ 'tw-border-red-500': errors.first_name }"
                        maxlength="20"
                        id="first_name"
                        type="text"
                        placeholder="שם פרטי"
                        v-model="auth.first_name"
                        @input="deleteError('first_name')"
                    />

                    <div
                        v-if="errors.first_name"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.first_name[0] }}
                    </div>
                </div>

                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="last_name"
                    >
                        שם משפחה
                    </label>
                    <input
                        class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        :class="{ 'tw-border-red-500': errors.last_name }"
                        maxlength="20"
                        id="last_name"
                        type="text"
                        placeholder="שם משפחה"
                        v-model="auth.last_name"
                        @input="deleteError('last_name')"
                    />

                    <div
                        v-if="errors.last_name"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.last_name[0] }}
                    </div>
                </div>

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
                        maxlength="50"
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
                        ></theory-pulse-loader>
                    </div>
                </div>

                <div class="tw-flex tw-flex-wrap tw-flex-col">
                    <div class="tw-mb-5">
                        <router-link
                            class="link tw-text-sm tw-font-bold"
                            :to="{ name: 'login' }"
                        >
                            יש לך כבר משתמש?
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
    name: "register",

    data() {
        return {
            auth: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },

            isLoading: false,

            errors: {}
        };
    },

    methods: {
        register() {
            if (this.isLoading) {
                return;
            }

            this.isLoading = true;

            this.$store
                .dispatch("register", this.auth)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: "home" });
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
        },

        deleteError(property) {
            this.errors[property] = null;
        }
    }
};
</script>
