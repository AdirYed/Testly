<template>
    <div class="home-body-child tw-w-80 tw-rounded tw-border">
        <div id="card-img" class="tw-w-full tw-rounded tw-rounded-b-none" :style="url"></div>
        <div class="tw-px-6 tw-py-4">
            <div class="tw-font-bold tw-text-xl tw-mb-2"><slot name="title"></slot></div>
            <p class="tw-text-gray-700 tw-text-base">
                <slot name="description"></slot>
            </p>
        </div>

        <div class="tw-flex tw-justify-center tw-pb-4">
            <button class="btn-scroll-down btn tw-bg-transparent tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded">
                למבחן תאוריה
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

            alt: {
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
