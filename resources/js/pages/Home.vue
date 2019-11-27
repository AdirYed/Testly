<template>
    <div>
        <div
            id="home-img-section"
            class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-justify-end"
        >
            <!-- TODO: needs some css changes -->
            <div id="products-wrapper">
                <div class="">
                    <h1 class="tw-text-center">מבחני תאוריה בחינם</h1>
                </div>
            </div>

            <div id="home-btn">
                <button
                    id="home-scroll-able"
                    class="btn tw-py-2 tw-px-8 tw-border-2 tw-border-primary tw-text-primary hover:tw-text-white hover:tw-bg-primary tw-rounded"
                    @click="readMore()"
                >
                    <fa-icon icon="angle-double-down" style="font-size: 30px" />
                </button>
            </div>
        </div>

        <!-- TODO: need to style it -->
        <div
            ref="homeBody"
            id="home-body"
            class="tw-container tw-mx-auto tw-flex tw-flex-wrap tw-flex-col tw-content-center"
        >
            <div class="tw-px-4 tw-pt-10">
                <h1 class="tw-text-3xl">
                    הנכם מוזמנים
                    <router-link class="link" :to="{ name: 'login' }"
                        >להירשם</router-link
                    >
                    לאתר כדי לשמור את נתונכם.
                </h1>
            </div>

            <section class="tw-flex tw-flex-wrap tw-justify-center tw-pt-10">
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
                <div class="tw-p-4">
                    <theory-card
                        src="/assets/action-asphalt.jpg"
                        alt="asphalt.jpg"
                    >
                        <template slot="title">זהו הכותרת</template>
                        זהו הדיסקריפשן
                        <template slot="button-desc">למבחן תאוריה</template>
                    </theory-card>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    name: "home",

    methods: {
        readMore() {
            window.scrollTo({
                top:
                    this.$refs.homeBody.offsetTop -
                    document.querySelector("#nav-bar").clientHeight,
                behavior: "smooth"
            });
        }
    }
};
</script>
