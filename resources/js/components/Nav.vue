<template>
    <header
        id="nav-bar"
        class="tw-min-w-full tw-bg-white tw-flex tw-flex-wrap tw-shadow-lg tw-items-center lg:tw-py-0 tw-py-2 lg:tw-px-24 tw-px-6 tw-sticky tw-top-0"
    >
        <div
            class="tw-hidden tw-flex-1 lg:tw-flex tw-justify-between tw-items-center"
        >
            <ul
                class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0"
            >
                <!-- Logo -->
                <router-link
                    :to="{ name: 'home' }"
                    class="tw-flex tw-items-center tw-px-4"
                    style="height: var(--header-height)"
                >
                    <div class="testly-icon tw-w-10 tw-h-10 tw-ml-1" />
                    <div class="tw-text-xl tw-text-primary tw-font-semibold">
                        טסטלי
                    </div>
                </router-link>

                <slot name="left-bar" />
            </ul>
        </div>

        <label for="menu-toggle" class="tw-pointer-cursor lg:tw-hidden block"
            ><svg
                class="tw-fill-current tw-text-gray-900"
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 20 20"
            >
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg
        ></label>
        <input class="tw-hidden" type="checkbox" id="menu-toggle" />

        <div
            class="tw-hidden lg:tw-flex lg:tw-items-center lg:tw-w-auto tw-w-full"
            id="menu"
        >
            <nav>
                <ul
                    class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0"
                >
                    <slot name="right-bar" />
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "nav-bar"
};
</script>
