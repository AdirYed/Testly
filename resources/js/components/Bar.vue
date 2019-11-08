<template>
        <router-link class="lg:tw-p-4 tw-py-3 tw-px-0 tw-block tw-border-b-2 tw-border-transparent hover:tw-border-primary lg:tw-mb-0 tw-mb-2" :class="{'tw-font-bold tw-border-primary' : isCurrentRoute}" :to="{ name: to }" exact>
            <slot></slot>
        </router-link>
</template>

<script>
    export default {
        name: 'bar',

        props: {
            to: {
                type: String,
                required: true,
            },
        },

        computed: {
            isCurrentRoute() {
                return this.$route.name === this.to;
            }
        }
    }
</script>
