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
            ref="testOptions"
            id="choose-a-test"
            class="tw-container tw-mx-auto"
        >
            <div class="tw-px-4 tw-py-8 md:tw-py-10">
                <h1 class="tw-text-xl md:tw-text-3xl">
                    <template v-if="!$store.getters.isLoggedIn">
                        מומלץ
                        <router-link class="link" :to="{ name: 'register' }"
                            >להירשם</router-link
                        >
                        לטסטלי כדי לשמור את היסטוריית המבחנים שלך.
                    </template>
                    <template v-else>
                        שלום
                        <router-link class="link" :to="{ name: 'dashboard' }">{{
                            $store.state.user.first_name
                        }}</router-link
                        >, איזה מבחן נעשה היום?
                    </template>
                </h1>
            </div>

            <section
                v-show="$store.state.drivingLicenseTypes"
                class="tw-w-full tw-flex tw-flex-wrap tw-justify-center"
            >
                <div
                    class="tw-p-4"
                    v-for="(test, index) in $store.state.drivingLicenseTypes"
                    :key="index"
                >
                    <theory-card
                        :src="test.image_url"
                        to="tests"
                        :params="{ drivingLicenseType: test.code }"
                    >
                        <template class="tw-text-center" slot="title">
                            {{ test.name }} ({{ test.code }})
                        </template>
                        כל השאלות והתשובות מהמאגר למבחן נהיגה עיוני ממוחשב ל{{
                            test.name
                        }}
                        ({{ test.code }})
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
                top: this.$refs.testOptions.offsetTop,
                behavior: "smooth"
            });
        }
    }
};
</script>

<style scoped>
#choose-a-test {
    margin-top: calc(var(--header-height) * -1);
    padding-top: var(--header-height);
}
</style>
