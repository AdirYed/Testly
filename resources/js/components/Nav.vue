<template>
    <header
        id="nav-bar"
        class="tw-min-w-full tw-bg-white tw-flex tw-flex-wrap tw-shadow-lg tw-items-center tw-py-0 md:tw-px-16 lg:tw-px-24 tw-px-3 tw-sticky tw-top-0"
    >
        <div
            class="tw-hidden tw-flex-1 md:tw-flex tw-justify-between tw-items-center"
        >
            <ul
                class="md:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 md:tw-pt-0"
            >
                <slot name="left-bar" />
            </ul>
        </div>

        <div
            class="tw-hidden md:tw-flex md:tw-items-center md:tw-w-auto tw-w-full"
            id="menu"
        >
            <nav>
                <ul
                    class="md:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 md:tw-pt-0"
                >
                    <slot name="right-bar" />
                </ul>
            </nav>
        </div>

        <burger-menu></burger-menu>
    </header>
</template>

<script>
import BurgerMenu from "./BurgerMenu";

export default {
    name: "nav-bar",

    components: {
        BurgerMenu
    }
};
</script>
