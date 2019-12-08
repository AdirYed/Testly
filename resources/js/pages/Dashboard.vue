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
                    class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-w-8/12 md:tw-w-7/12 lg:tw-w-6/12 tw-mx-auto"
                >
                    <div
                        v-for="category in categories"
                        v-if="percentage[category.id]"
                        class="tw-w-8/12 md:tw-w-7/12 lg:tw-w-6/12 tw-my-3"
                    >
                        <div class="tw-text-md md:tw-text-lg">
                            {{ category.name }}
                            -
                            {{ Math.floor(percentage[category.id]) }}%
                        </div>

                        <div class="tw-bg-gray-300 tw-mt-2">
                            <div
                                class="tw-bg-primary"
                                style="height: 0.15rem;"
                                :style="
                                    'width: ' + percentage[category.id] + '%'
                                "
                            ></div>
                        </div>
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
                            {{ testReport.driving_license_type.name }}
                        </div>

                        <div class="tw-w-3/12">
                            30/{{ testReport.correct_answers_count }} תשובות
                            נכונות
                        </div>

                        <div class="tw-w-3/12">
                            {{
                                minutes(
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
            testReportErrors: false,
            categoriesErrors: false,

            categories: null,

            percentage: null
        };
    },

    created() {
        this.init();
    },

    methods: {
        init() {
            this.isLoading = true;
            this.testReportErrors = false;

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

                    this.calcPercentage();

                    this.$store
                        .dispatch("fetchCategoryTypes")
                        .then(response => {
                            this.categories = response.data;

                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.categoriesErrors = error;
                        });
                })
                .catch(error => {
                    this.testReportErrors = error;
                });
        },

        calcPercentage() {
            let categories = [];
            let counter = [];

            this.testReports.forEach(function(item) {
                const successByCategories = JSON.parse(
                    JSON.stringify(item.success_by_categories)
                );

                Object.keys(successByCategories).forEach(function(index) {
                    if (!categories[index] && categories[index] !== 0) {
                        categories[index] = successByCategories[index].percent;
                        counter[index] = 1;
                    } else {
                        categories[index] += successByCategories[index].percent;
                        counter[index]++;
                    }
                });
            });

            categories.forEach(function(item, index) {
                categories[index] = item / counter[index];
            });

            this.percentage = categories;
        },

        minutes(ms) {
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
