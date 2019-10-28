<template>
    <div class="home-body-child tw-max-w-sm tw-rounded tw-overflow-hidden tw-shadow-lg tw-border">
        <img class="tw-w-full" :src="src" :alt="alt">
        <div class="tw-px-6 tw-py-4">
            <div class="tw-font-bold tw-text-xl tw-mb-2"><slot name="title"></slot></div>
            <p class="tw-text-gray-700 tw-text-base">
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

            alt: {
                type: String,
                require: true,
            },
        },
    };
</script>


<!--<template>-->
<!--    <div class="home-body-child tw-max-w-sm tw-rounded tw-overflow-hidden tw-shadow-lg tw-border">-->
<!--        <div id="card-img" class="tw-w-full" :style="url"></div>-->
<!--        <div class="tw-px-6 tw-py-4">-->
<!--            <div class="tw-font-bold tw-text-xl tw-mb-2"><slot name="title"></slot></div>-->
<!--            <p class="tw-text-gray-700 tw-text-base">-->
<!--                <slot name="description"></slot>-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
