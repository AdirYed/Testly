<template>
    <div>
        <div
            class="progressBar progressBarTransition tw-fixed"
            :style="progressBarStyle"
        ></div>
        <div
            class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
        >
            <h1
                class="tw-flex tw-flex-wrap tw-justify-between tw-text-center tw-items-center"
            >
                <div
                    class="tw-w-full md:tw-w-10/12 tw-text-2xl md:tw-text-3xl tw-font-semibold"
                >
                    מבחן תאוריה

                    <template v-if="drivingLicenseType">
                        -
                        {{ drivingLicenseType.name }}
                        ({{ drivingLicenseType.code }})
                    </template>
                </div>

                <div
                    class="tw-hidden md:tw-block tw-w-2/12"
                    v-if="drivingLicenseType"
                >
                    <router-link
                        :to="{
                            name: 'tests',
                            params: {
                                drivingLicenseType: drivingLicenseType.code
                            }
                        }"
                    >
                        <button
                            class="tw-text-sm tw-border tw-rounded tw-p-2"
                            style="border-color: rgba(0, 0, 0, 0.25);"
                        >
                            התחל מחדש
                        </button>
                    </router-link>
                </div>
            </h1>

            <template v-if="!isLoading">
                <div
                    v-if="question"
                    class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5 tw-break-words tw-h-full"
                >
                    <div
                        class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between lg:tw-pl-16 lg:tw-w-9/12 xl:tw-w-10/12 tw-w-full"
                    >
                        <div>
                            <div
                                class="tw-font-medium tw-text-lg md:tw-text-2xl"
                            >
                                <span class="tw-text-xl md:tw-text-3xl"
                                    >{{ currQuestion }}.</span
                                >
                                {{ title }}
                            </div>

                            <ul
                                class="tw-flex tw-flex-wrap tw-flex-col tw--my-1 tw-mt-1"
                            >
                                <li
                                    class="tw-w-full tw-py-1"
                                    v-for="(response, index) in answers"
                                >
                                    <label
                                        class="tw-block tw-p-2 tw-border tw-border-transparent tw-rounded tw-w-full"
                                        :class="{
                                            'tw-bg-primary':
                                                quiz.test_report_answers[
                                                    currQuestion - 1
                                                ]['answer_id'] === response.id,
                                            // score
                                            'tw-text-green-700 tw-font-bold tw-border-primary':
                                                response['is_correct'],
                                            'tw-text-red-500 tw-font-bold':
                                                !response['is_correct'] &&
                                                quiz.test_report_answers[
                                                    currQuestion - 1
                                                ]['answer_id'] === response.id
                                        }"
                                        :for="
                                            'q_' + currQuestion + '_a_' + index
                                        "
                                        :key="
                                            'q_' + currQuestion + '_a_' + index
                                        "
                                    >
                                        <input
                                            class="tw-opacity-0 tw-h-0 tw-w-0"
                                            type="radio"
                                            :name="'q_' + questionId"
                                            :id="
                                                'q_' +
                                                    currQuestion +
                                                    '_a_' +
                                                    index
                                            "
                                            :key="
                                                'q_' +
                                                    currQuestion +
                                                    '_a_' +
                                                    index
                                            "
                                            :value="index"
                                            v-model="
                                                question['chosen_answer_id']
                                            "
                                            disabled
                                        />
                                        {{ response["content"] }}
                                    </label>
                                </li>
                            </ul>

                            <div v-if="img" class="tw-my-2">
                                <div
                                    class="questioning-img tw-mx-auto tw-h-32 lg:tw-h-48 tw-my-3"
                                    :style="{
                                        'background-image': 'url(' + img + ')'
                                    }"
                                ></div>
                            </div>
                        </div>

                        <div>
                            <div class="tw-flex tw-flex-wrap tw-flex-col">
                                <div
                                    class="tw-mx-auto tw-my-2 tw-max-w-24 tw-text-center"
                                >
                                    <div class="tw-text-md md:tw-text-xl">
                                        <div
                                            class="tw-border tw-border-transparent tw-p-4 tw-rounded"
                                            :class="{
                                                'tw-border-green-700':
                                                    rightAnswersAmount >= 26,
                                                'tw-border-red-500':
                                                    rightAnswersAmount < 26
                                            }"
                                        >
                                            <div>
                                                <template
                                                    v-if="
                                                        rightAnswersAmount >= 26
                                                    "
                                                >
                                                    עברת את המבחן בהצלחה!
                                                </template>

                                                <template v-else>
                                                    נכשלת במבחן...
                                                </template>
                                            </div>

                                            ענית נכון על
                                            <span>{{
                                                rightAnswersAmount
                                            }}</span>
                                            מתוך
                                            {{
                                                quiz.test_report_answers.length
                                            }}
                                            שאלות.
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="tw-flex tw-flex-wrap tw-justify-between md:tw-h-full"
                                >
                                    <button
                                        class="tw-w-2/12 lg:tw-w-1/12 tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                                        @click="prev()"
                                        :disabled="lowerThanZero()"
                                        :class="{
                                            'btn-disabled': lowerThanZero()
                                        }"
                                    >
                                        <fa-icon
                                            class="tw-text-2xl md:tw-text-3xl"
                                            icon="chevron-right"
                                        />
                                    </button>

                                    <div
                                        class="tw-w-8/12 lg:tw-w-10/12 tw-px-2"
                                    >
                                        <router-link
                                            :to="{
                                                name: 'tests',
                                                params: {
                                                    drivingLicenseType:
                                                        drivingLicenseType.code
                                                }
                                            }"
                                        >
                                            <button
                                                class="tw-font-bold tw-w-full tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                                            >
                                                התחל מחדש
                                            </button>
                                        </router-link>
                                    </div>

                                    <button
                                        class="tw-w-2/12 lg:tw-w-1/12 tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                                        @click="next()"
                                        :disabled="higherThanThirty()"
                                        :class="{
                                            'btn-disabled': higherThanThirty()
                                        }"
                                    >
                                        <fa-icon
                                            class="tw-text-2xl md:tw-text-3xl"
                                            icon="chevron-left"
                                        />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <aside
                        class="tw-hidden lg:tw-block lg:tw-w-3/12 xl:tw-w-2/12"
                        style="direction: ltr"
                    >
                        <section
                            class="tw-border tw-py-3 tw-rounded"
                            style="direction: rtl; border-color: rgba(0, 0, 0, 0.25);"
                        >
                            <div
                                class="tw-flex tw-flex-wrap tw-justify-between tw-mx-auto"
                                style="width: 90%"
                            >
                                <button
                                    v-for="(i, n) in quiz.test_report_answers
                                        .length"
                                    class="tw-py-2 tw-my-1 tw-text-center tw-border tw-border-transparent tw-rounded tw-text-sm hover:tw-border-primary"
                                    style="width: 45%"
                                    @click="currentQuestion(n)"
                                    :class="{
                                        'tw-border-primary tw-bg-primary':
                                            i !== currQuestion &&
                                            quiz.test_report_answers[n][
                                                'answer_id'
                                            ] !== null,
                                        'tw-text-green-700 tw-font-bold':
                                            rightAnswer(n) ===
                                            quiz.test_report_answers[n][
                                                'answer_id'
                                            ],
                                        'tw-text-red-500 tw-font-bold':
                                            rightAnswer(n) !==
                                                quiz.test_report_answers[n][
                                                    'answer_id'
                                                ] &&
                                            quiz.test_report_answers[n][
                                                'answer_id'
                                            ] !== null,
                                        'tw-border-primary': i === currQuestion
                                    }"
                                >
                                    שאלה {{ i }}
                                </button>
                            </div>
                        </section>
                    </aside>
                </div>
            </template>

            <div v-else-if="error === 'uuid'" class="tw-pt-5">
                <div class="tw-text-xl">
                    מבחן זה אינו קיים במערכת.
                </div>
            </div>

            <div
                class="tw-container tw-mx-auto tw-flex tw-justify-center"
                v-else
            >
                <theory-pulse-loader
                    class="tw-absolute"
                    style="top: 50%;"
                    :loading="isLoading"
                    color="var(--primary-color)"
                    size="40px"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "test-result",

    data() {
        return {
            quiz: [],

            drivingLicenseType: null,

            questionIndex: 0,
            rightAnswersAmount: null,

            time: 40 * 60 * 1000,
            progressBarStyle: {
                width: "0%"
            },

            error: null
        };
    },

    methods: {
        currentQuestion(index) {
            this.questionIndex = index;
        },

        next() {
            if (this.questionIndex < 29 && this.questionIndex >= 0) {
                this.questionIndex++;
            }
        },

        prev() {
            if (this.questionIndex <= 29 && this.questionIndex > 0) {
                this.questionIndex--;
            }
        },

        lowerThanZero() {
            return this.questionIndex <= 0;
        },

        higherThanThirty() {
            return this.questionIndex >= 29;
        },

        rightAnswer(question) {
            for (let i = 0; i < 4; i++) {
                if (
                    this.quiz.test_report_answers[question]["question"][
                        "answers"
                    ][i]["is_correct"]
                ) {
                    return this.quiz.test_report_answers[question]["question"][
                        "answers"
                    ][i]["id"];
                }
            }
        },

        rightAnswers() {
            let rightAnswers = 0;

            for (let i = 0; i < this.quiz.test_report_answers.length; i++) {
                if (
                    this.quiz.test_report_answers[i]["answer_id"] !== null &&
                    this.rightAnswer(i) ===
                        this.quiz.test_report_answers[i]["answer_id"]
                ) {
                    rightAnswers++;
                }
            }

            return rightAnswers;
        },

        handleCountdownProgress() {
            const totalMilliseconds =
                this.time -
                (new Date(this.quiz.finished_at).getTime() -
                    new Date(this.quiz.started_at).getTime());

            this.progressBarStyle = {
                width: (totalMilliseconds / this.time) * 100 + "%"
            };
        }
    },

    computed: {
        currQuestion() {
            return this.questionIndex + 1;
        },

        question() {
            return this.quiz.test_report_answers[this.questionIndex][
                "question"
            ];
        },

        title() {
            return this.question["title"];
        },

        answers() {
            return this.question["answers"];
        },

        img() {
            return this.question["formatted_image_url"];
        },

        questionId() {
            return this.question["id"];
        },

        isLoading() {
            return Array.isArray(this.quiz);
        }
    },

    created() {
        this.$axios
            .get(`/test-reports/${this.$route.params.uuid}`)
            .then(response => {
                let data = response.data;

                if (this.$store.state.drivingLicenseTypes) {
                    this.drivingLicenseType = this.$store.state.drivingLicenseTypes[
                        data["driving_license_type_id"] - 1
                    ];
                }

                this.quiz = data;

                this.handleCountdownProgress();
                this.rightAnswersAmount = this.rightAnswers();
            })
            .catch(error => {
                if (
                    error.response.status === 422 &&
                    error.response.data.error === "uuid"
                ) {
                    this.error = "uuid";
                }
            });
    }
};
</script>
