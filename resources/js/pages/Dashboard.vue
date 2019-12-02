<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div
            class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center tw-mb-5"
        >
            הפרופיל שלי
        </div>

        <div class="tw-text-center tw-mb-5">
            <div class="tw-text-lg md:tw-text-2xl">
                אחוז מוכנות
            </div>

            <div
                class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-w-6/12 tw-mx-auto"
            >
                <div class="tw-w-6/12 tw-my-3">
                    חוקי התנועה - 50%

                    <div class="tw-bg-gray-300 tw-mt-2">
                        <div
                            class="tw-bg-primary"
                            style="height: 0.15rem; width: 50%"
                        ></div>
                    </div>
                </div>

                <div>
                    תמרורים
                </div>

                <div>
                    הכרת הרכב
                </div>

                <div>
                    בטיחות
                </div>
            </div>
        </div>

        <div class="tw-text-center">
            <div class="tw-text-lg md:tw-text-2xl tw-mb-5">
                היסטוריית מבחנים
            </div>

            <div v-if="loading">
                <theory-pulse-loader color="var(--primary-color)" size="40px" />
            </div>

            <div v-else>
                <div
                    class="tw-flex tw-justify-between tw-w-8/12 tw-mx-auto"
                    v-for="testReport in testReports"
                    :key="testReport.id"
                >
                    <div>
                        04/02/2019 22:04
                    </div>

                    <div>{{ testReport.correct_answers }}/30 שאלות נכונות</div>

                    <div>
                        30/10 שאלות נכונות
                    </div>

                    <div>
                        לקח לך 10 דקות לסיים
                    </div>

                    <div>
                        צפה במבחן
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "dashboard",
    data() {
        return {
            testReports: [],
            loading: true,
            error: false
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.loading = true;
            this.error = false;

            this.$store
                .dispatch("fetchTestReports")
                .then(response => {
                    this.testReports = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = error;
                });
        }
    }
};
</script>
