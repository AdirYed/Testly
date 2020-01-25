<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            צור קשר
        </div>

        <div
            class="tw-w-full tw-max-w-2xl tw-text-lg tw-pt-5 tw-text-center tw-mx-auto"
        >
            <p class="tw-mb-2">
                מוזמנים לשלוח אלינו את בקשתכם, הצעות לשיפור, הערות או תלונות.
            </p>

            <p>
                כל פנייה תתקבל בברכה ותענה בהקדם האפשרי.
            </p>
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto">
            <form
                class="tw-rounded tw-px-8 tw-pt-5"
                method="post"
                @submit.prevent="contact"
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
                        v-model="payload.first_name"
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
                        v-model="payload.last_name"
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
                        v-model="payload.email"
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
                        for="subject"
                    >
                        נושא
                    </label>
                    <input
                        class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
                        :class="{ 'tw-border-red-500': errors.subject }"
                        maxlength="50"
                        id="subject"
                        type="text"
                        placeholder="נושא"
                        v-model="payload.subject"
                        @input="deleteError('subject')"
                    />

                    <div
                        v-if="errors.subject"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.subject[0] }}
                    </div>
                </div>

                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="description"
                    >
                        תוכן
                    </label>
                    <textarea
                        class="input resize-y transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight tw-overflow-x-hidden"
                        style="min-height: 38px"
                        :class="{ 'tw-border-red-500': errors.description }"
                        maxlength="500"
                        id="description"
                        placeholder="תוכן"
                        rows="4"
                        v-model="payload.description"
                        @input="deleteError('description')"
                    />

                    <div
                        v-if="errors.description"
                        class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
                    >
                        {{ errors.description[0] }}
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
                </div>

                <div class="tw-flex tw-flex-wrap tw-flex-col">
                    <button
                        class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                        type="submit"
                    >
                        שלח
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "contact-us",

    data() {
        return {
            payload: {
                first_name: "",
                last_name: "",
                email: "",
                subject: "",
                description: ""
            },

            isLoading: false,

            errors: {}
        };
    },

    methods: {
        contact() {
            if (this.isLoading) {
                return;
            }

            this.isLoading = true;

            this.$axios
                .post("contact-us", this.payload)
                .then(() => {
                    this.isLoading = false;

                    this.$toast.success("טופס נשלח.");

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
    },

    created() {
        if (this.$store.state.user) {
            this.payload.first_name = this.$store.state.user.first_name;
            this.payload.last_name = this.$store.state.user.last_name;
            this.payload.email = this.$store.state.user.email;
        }
    }
};
</script>
