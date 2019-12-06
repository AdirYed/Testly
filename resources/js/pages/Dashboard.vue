<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div
            class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center tw-mb-5"
        >
            הפרופיל שלי
        </div>

        <div
            v-if="isLoading"
            class="tw-container tw-mx-auto tw-flex tw-justify-center"
        >
            <theory-pulse-loader
                class="tw-absolute"
                style="top: 50%;"
                :loading="isLoading"
                color="var(--primary-color)"
                size="40px"
            />
        </div>

        <template v-else>
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

                <div>
                    <div
                        class="tw-flex tw-justify-center tw-w-8/12 tw-mx-auto"
                        v-for="testReport in testReports"
                        :key="testReport.id"
                    >
                        <div class="tw-w-3/12" style="direction: ltr">
                            {{ date(testReport.finished_at) }}
                        </div>

                        <div class="tw-w-3/12">
                            30/{{ testReport.correct_answers }} שאלות נכונות
                        </div>

                        <div class="tw-w-3/12">
                            {{
                                mins(
                                    testReport.finished_at -
                                        testReport.started_at
                                )
                            }}
                        </div>

                        <div class="tw-w-3/12">
                            צפה במבחן
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "dashboard",
    data() {
        return {
            testReports: [],
            isLoading: true,
            error: false
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.isLoading = true;
            this.error = false;

            this.$store
                .dispatch("fetchTestReports")
                .then(response => {
                    this.testReports = response.data;

                    this.testReports.forEach(function(testReport) {
                        testReport.started_at = Date.parse(
                            testReport.started_at
                        );
                        testReport.finished_at = Date.parse(
                            testReport.finished_at
                        );
                    });

                    this.isLoading = false;
                })
                .catch(error => {
                    this.error = error;
                });
        },

        mins(ms) {
            const date = new Date(ms);

            return `${this.appendLeadingZeroes(
                date.getMinutes()
            )}:${this.appendLeadingZeroes(date.getSeconds())}`;
        },

        date(ms) {
            const date = new Date(ms);

            return `${this.appendLeadingZeroes(
                date.getHours()
            )}:${this.appendLeadingZeroes(
                date.getMinutes()
            )} - ${this.appendLeadingZeroes(
                date.getDay() + 1
            )}/${this.appendLeadingZeroes(
                date.getMonth() + 1
            )}/${date.getFullYear()}`;
        },

        appendLeadingZeroes(n) {
            if (n <= 9) {
                return "0" + n;
            }

            return n;
        }
    }
};
</script>
