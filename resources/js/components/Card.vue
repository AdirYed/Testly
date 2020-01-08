<template>
    <div class="card tw-border tw-rounded" :style="size()">
        <div
            v-if="src"
            class="card-img tw-w-full tw-rounded tw-rounded-b-none"
            :style="{ 'background-image': 'url(' + src + ')' }"
        ></div>
        <div class="tw-px-6 tw-py-4">
            <div class="tw-font-bold tw-text-xl tw-mb-2">
                <slot name="title" />
            </div>
            <p class="tw-text-gray-700 tw-text-base">
                <slot />
            </p>
        </div>

        <div class="tw-flex tw-justify-center tw-pb-4">
            <router-link
                class="btn tw-py-2 tw-px-3 tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded"
                :to="{
                    name: to,
                    params: params
                }"
            >
                <slot name="button-desc" />
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "card",

    props: {
        src: {
            type: String
        },

        width: {
            type: Number,
            default: 80
        },

        to: {
            type: String,
            required: true
        },

        params: {
            type: Object,
            required: false
        }
    },

    methods: {
        size() {
            return `width: ${this.width / 4}rem`;
        }
    }
};
</script>
