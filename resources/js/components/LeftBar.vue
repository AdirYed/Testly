<template>
    <li><a class="lg:tw-p-4 tw-py-3 tw-px-0 tw-block tw-border-b-2 tw-border-transparent hover:tw-border-primary" :href="href"><slot></slot></a></li>
</template>

<script>
    export default {
        name: 'left-bar',

        props: {
            href: {
                type: String,
                required: true,
            },
        },
    }
</script>
