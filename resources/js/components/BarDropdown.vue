<template>
    <div
        class="tw-relative"
        @mouseenter="!isMobile ? (isOpen = true) : null"
        @mouseleave="isOpen = false"
    >
        <router-link :to="{ name: buttonTo }" v-if="buttonTo && !isMobile">
            <button
                @click="isOpen = !isOpen"
                class="route tw-p-4 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary"
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
            class="route tw-p-4 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary"
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

    computed: {
        isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            );
        }
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
