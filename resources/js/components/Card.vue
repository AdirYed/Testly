<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg border-2">
        <img class="w-full" :src="src" alt="action-aspalt.jpg">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2"><slot name="title"></slot></div>
            <p class="text-gray-700 text-base">
                <slot name="description"></slot>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'card',

        props: {
            src: {
                type: String,
                require: true,
            },
        },
    };
</script>
