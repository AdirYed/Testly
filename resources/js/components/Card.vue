<template>
    <div class="home-body-child tw-w-80 tw-border tw-rounded tw-word-wrap">
        <div class="card-img tw-w-full tw-rounded tw-rounded-b-none" :style="url"></div>
        <div class="tw-px-6 tw-py-4">
            <div class="tw-font-bold tw-text-xl tw-mb-2"><slot name="title"></slot></div>
            <p class="tw-text-gray-700 tw-text-base">
                <slot></slot>
            </p>
        </div>

        <div class="tw-flex tw-justify-center tw-pb-4">
            <button class="btn tw-py-2 tw-px-3 tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded">
                <slot name="button-desc"></slot>
            </button>
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

        data() {
            return {
                url: 'background-image: url(' + this.src + ')',
            };
        },
    };
</script>
