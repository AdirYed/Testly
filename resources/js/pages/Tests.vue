<template>
    <!--submit button will have a computed gradient-->
    <div id="tests-container" class="tw-container tw-mx-auto tw-pt-10">
        <h1 class="tw-text-3xl tw-text-center">
            מבחן תאוריה - רכב פרטי (B)
        </h1>

        <div class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5">
            <div class="tw-px-5" style="width: calc(100% - 200px)">
                <div class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between">
                    <button>
                        שאלה קודמת
                    </button>

                    <p class="tw-text-2xl">
                        (1) מתי לא ירשו נהג או כרטיסן את עלייתו של נוסע לאוטובוס?
                    </p>

                    <button>
                        שאלה הבאה
                    </button>
                </div>
            </div>

            <aside style="direction: ltr">
                <section class="tw-flex tw-flex-wrap tw-justify-start tw-border tw-py-3 tw-rounded" style="width: 200px; direction: rtl; border-color: rgba(0, 0, 0, 0.25);">
                    <div v-for="i in 30" class="tw-my-3 tw-w-1/2 tw-text-center">
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
