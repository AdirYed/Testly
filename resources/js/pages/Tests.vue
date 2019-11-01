<template>
    <!--submit button will have a computed gradient-->
    <div id="tests-container" class="tw-container tw-mx-auto tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-10">
        <h1 class="tw-text-3xl tw-pr-4">
            מבחן תאוריה
        </h1>

        <aside class="" style="direction: ltr">
            <section class="tw-flex tw-flex-wrap tw-justify-start tw-border tw-py-3 tw-rounded" style="width: 200px; direction: rtl;">
                <div v-for="i in 30" class="tw-my-3 tw-w-1/3 tw-text-center">
                        {{ i }}
                </div>
            </section>
        </aside>
    </div>
</template>

<script>
    export default {
        name: 'tests',
    };
</script>
