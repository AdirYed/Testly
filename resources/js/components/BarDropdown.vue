<template>
    <div class="tw-relative">
        <router-link :to="{ name: buttonTo }" v-if="buttonTo">
            <button
                @click="isOpen = !isOpen"
                @mouseenter="isOpen = true"
                @mouseleave="isOpen = false"
                class="route lg:tw-p-4 tw-py-3 tw-px-0 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary lg:tw-mb-0 tw-mb-2"
                :class="{
                    'tw-font-bold ': this.$route.name === to,
                    'tw-border-primary': isOpen || this.$route.name === to
                }"
            >
                <slot name="title" />
            </button>
        </router-link>

        <button
            v-else
            @click="isOpen = !isOpen"
            @mouseenter="isOpen = true"
            @mouseleave="isOpen = false"
            class="route lg:tw-p-4 tw-py-3 tw-px-0 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary lg:tw-mb-0 tw-mb-2"
            :class="{
                'tw-font-bold ': this.$route.name === to,
                'tw-border-primary': isOpen || this.$route.name === to
            }"
        >
            <slot name="title" />
        </button>

        <div
            v-if="isOpen"
            class="tw-absolute tw-py-1 tw-w-56 tw-bg-white tw-rounded tw-border"
            style="border-color: rgba(0, 0, 0, 0.25); left: 50%; margin-left: -6rem"
            @click="isOpen = false"
            @mouseenter="isOpen = true"
            @mouseleave="isOpen = false"
        >
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    name: "bar-dropdown",

    props: {
        to: {
            type: String,
            required: true
        },

        buttonTo: {
            type: String,
            required: false
        }
    },

    data() {
        return {
            isOpen: false
        };
    },

    created() {
        const handleEscape = e => {
            if (e.key === "Esc" || e.key === "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    }
};
</script>
