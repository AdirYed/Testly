<template>
    <div class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-10">
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            התחבר
        </div>

        <div class="tw-w-full tw-max-w-full">
            <form
                class="tw-bg-white tw-shadow-md tw-rounded tw-px-8 tw-pt-6 tw-pb-8 tw-mb-4"
            >
                <div class="tw-mb-4">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="email"
                    >
                        אימייל
                    </label>
                    <input
                        class="tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id="email"
                        type="email"
                        placeholder="אימייל"
                    />
                </div>
                <div class="tw-mb-6">
                    <label
                        class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
                        for="password"
                    >
                        סיסמא
                    </label>
                    <input
                        class="tw-shadow tw-appearance-none tw-border tw-border-red-500 tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-mb-3 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline"
                        id="password"
                        type="password"
                        placeholder="******************"
                    />
                    <p class="tw-text-red-500 tw-text-xs tw-italic">
                        Please choose a password.
                    </p>
                </div>
                <div class="tw-flex tw-items-center tw-justify-between">
                    <button
                        class="tw-bg-blue-500 hover:tw-bg-blue-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded focus:tw-outline-none focus:tw-shadow-outline"
                        type="button"
                    >
                        Sign In
                    </button>
                    <a
                        class="tw-inline-block tw-align-baseline tw-font-bold tw-text-sm tw-text-blue-500 hover:tw-text-blue-800"
                        href="#"
                    >
                        שכחת סיסמא?
                    </a>
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
