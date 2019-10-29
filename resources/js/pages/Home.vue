<template>
    <div>
        <div id="home-img-section" class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-justify-end">
            <!-- TODO: needs some css changes -->
            <div id="products-wrapper">
                                <div class="">
                                    <h1 class="tw-text-center">מבחני תאוריה בחינם</h1>
                                </div>
                            </div>

                            <div id="home-btn">
                                <button id="home-scroll-able" class="btn tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded">
                                    קרא/י עוד
                </button>
            </div>
        </div>

        <!-- TODO: need to style it -->
        <div id="home-body" class="tw-container tw-flex tw-flex-wrap tw-flex-col">
            <div class="tw-p-4 tw-pt-10" style="direction: rtl">
                <h1 class="tw-text-3xl">
                    הנכם מוזמנים
                    <a class="tw-text-primary tw-border-b tw-border-transparent hover:tw-border-primary" href="#">להירשם</a>
                    לאתר כדי לשמור את נתונכם.
                </h1>
            </div>

            <section class="tw-flex tw-flex-wrap tw-justify-center tw-pt-10">
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>
                            This is the description.
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
    };
</script>
