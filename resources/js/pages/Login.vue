<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            התחבר
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto">
            <form class="tw-rounded tw-px-8 tw-pt-6 tw-pb-8 tw-mb-5">
                <div class="tw-mb-5">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="email"
                    >
                        אימייל
                    </label>
                    <input
                        class="tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-border-transparent focus-shadow-outline-primary"
                        id="email"
                        type="email"
                        placeholder="אימייל"
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
                        class="tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-border-transparent focus-shadow-outline-primary"
                        id="password"
                        type="password"
                        placeholder="סיסמה"
                    />
                </div>

                <p
                    v-if="false"
                    class="tw-font-semibold tw-text-red-500 tw-text-xs tw-my-3"
                >
                    הפרטים שהזנת שגוים!
                </p>

                <div class="tw-flex tw-flex-wrap tw-flex-col">
                    <div class="tw-mb-5">
                        <router-link
                            class="tw-font-bold tw-text-sm tw-text-primary hover:tw-underline"
                            :to="{ name: 'forgot-password' }"
                        >
                            שכחת את הסיסמה?
                        </router-link>
                    </div>

                    <button
                        class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                        type="button"
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
    name: "login"
};
</script>

<style>
input {
    outline: 0;
}

.focus-shadow-outline-primary:focus {
    box-shadow: 0 0 0 3px var(--primary-color);
}
</style>
