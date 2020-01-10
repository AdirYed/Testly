<template>
    <router-link
        class="route tw-p-4 tw-block tw-border-t-4 tw-border-transparent hover:tw-border-primary"
        :class="{ 'tw-font-bold tw-border-primary': isCurrentRoute }"
        :to="{ name: to, params: toParams }"
        exact
    >
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    name: "bar",

    props: {
        to: {
            type: String,
            required: false
        },

        toParams: {
            type: Object,
            default: () => {
                return {};
            }
        }
    },

    computed: {
        isCurrentRoute() {
            return this.$route.name === this.to;
        }
    }
};
</script>

<style>
.route {
    transition: border 0.2s ease;
}
</style>
