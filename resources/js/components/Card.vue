<template>
    <div class="card tw-border tw-rounded tw-w-64 md:tw-w-80">
        <div
            v-if="src"
            class="card-img tw-hidden md:tw-block tw-w-full tw-rounded tw-rounded-b-none"
            :style="{ 'background-image': 'url(' + src + ')' }"
        ></div>
        <div class="tw-px-6 tw-py-4">
            <div class="tw-font-bold tw-text-xl tw-mb-2 tw-text-center">
                <slot name="title" />
            </div>
            <p class="tw-text-gray-700 tw-text-center">
                <slot />
            </p>
        </div>

        <div class="tw-flex tw-justify-center tw-pb-4">
            <router-link
                class="btn tw-py-1 md:tw-py-2 tw-px-3 tw-border-2 tw-border-primary tw-text-primary tw-rounded"
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

        to: {
            type: String,
            required: true
        },

        params: {
            type: Object,
            required: false
        }
    }
};
</script>

<style scoped>
@media (hover: hover) and (pointer: fine) {
    .btn:hover {
        @apply tw-text-white tw-bg-primary;
    }
}

.btn:active {
    @apply tw-text-white tw-bg-primary;
}
</style>
