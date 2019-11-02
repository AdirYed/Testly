<template>
    <!--submit button will have a computed gradient-->
    <div id="tests-container" class="tw-container tw-mx-auto tw-pt-10">
        <h1 class="tw-text-3xl tw-text-center">
            מבחן תאוריה - רכב פרטי (B)
        </h1>

        <div class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5">
            <div class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between tw-px-16" style="width: calc(100% - 300px)">
                <div>
                    <div class="tw-text-2xl">
                        <span class="tw-text-3xl">1.</span>
                        מתי לא ירשו נהג או כרטיסן את עלייתו של נוסע לאוטובוס?
                    </div>

                    <ul>
                        <li>
                            <input type="radio" name="q_1" value="0" id="q_1">
                            <label for="q_1">טסט</label>
                        </li>
                        <li>
                            <input type="radio" name="q_1" value="1" id="q_2">
                            <label for="q_2">טסט</label>
                        </li>
                        <li>
                            <input type="radio" name="q_1" value="2" id="q_3">
                            <label for="q_3">טסט</label>
                        </li>
                        <li>
                            <input type="radio" name="q_1" value="3" id="q_4">
                            <label for="q_4">טסט</label>
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="tw-flex tw-flex-wrap tw-justify-between">
                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white">
                            <fa-icon icon="chevron-right" size="2x" />
                        </button>

                        <div class="tw-w-10/12 tw-px-2">
                            <!--submit button-->
                            <button class="btn tw-w-full tw-bg-primary tw-rounded tw-text-white">
                                סיים מבחן
                            </button>
                        </div>

                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white">
                            <fa-icon icon="chevron-left" size="2x" />
                        </button>
                    </div>
                </div>
            </div>

            <aside style="direction: ltr">
                <section class="tw-flex tw-flex-wrap tw-justify-start tw-border tw-py-3 tw-rounded" style="width: 300px; direction: rtl; border-color: rgba(0, 0, 0, 0.25);">
                    <div v-for="i in 30" class="tw-my-3 tw-w-1/3 tw-text-center">
                        שאלה {{ i }}
                    </div>
                </section>
            </aside>
        </div>

        <div class="tw-mt-80"></div>
    </div>
</template>

<script>
    export default {
        name: 'tests',
    };
</script>
