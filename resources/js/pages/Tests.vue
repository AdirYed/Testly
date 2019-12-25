<template>
    <div dusk="quiz">
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
                    <template v-if="drivingLicenseType">
                        מבחן תאוריה -
                        {{ drivingLicenseType.name }}
                        ({{ drivingLicenseType.code }})
                    </template>

                    <template v-else>
                        מבחן תאוריה
                    </template>
                </div>

                <div class="tw-hidden md:tw-block tw-w-2/12">
                    <button
                        class="tw-text-sm tw-border tw-rounded tw-p-2"
                        style="border-color: rgba(0, 0, 0, 0.25);"
                        @click="restart"
                    >
                        התחל מחדש
                    </button>
                </div>
            </h1>

            <template v-if="!isLoading">
                <div
                    v-if="question"
                    id="test-body"
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
                                        class="tw-block tw-p-2 tw-border tw-border-transparent tw-rounded tw-cursor-pointer tw-w-full"
                                        :class="{
                                            'hover:tw-border-primary hover:tw-text-primary':
                                                question['chosen_answer_id'] !==
                                                    ++index && counting,
                                            'tw-bg-primary':
                                                question['chosen_answer_id'] ===
                                                index,
                                            // score
                                            'tw-text-green-700 tw-font-bold tw-border-primary':
                                                !counting &&
                                                response['is_correct'],
                                            'tw-text-red-500 tw-font-bold':
                                                !counting &&
                                                !response['is_correct'] &&
                                                question['chosen_answer_id'] ===
                                                    index
                                        }"
                                        :for="
                                            'q_' + currQuestion + '_a_' + index
                                        "
                                    >
                                        <!-- rightAnswer(questionIndex) - aims only for the right answer-->

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
                                            @change="next()"
                                            :disabled="!counting"
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
                                    <div
                                        :class="{
                                            'tw-border-2 tw-border-primary tw-rounded tw-py-3 tw-px-4 tw-text-md md:tw-text-xl': counting
                                        }"
                                    >
                                        <theory-countdown
                                            :time="time"
                                            @progress="handleCountdownProgress"
                                            @end="score"
                                            ref="countdown"
                                            v-show="counting"
                                        >
                                            <template slot-scope="props">
                                                {{ props.minutes }}:{{
                                                    props.seconds
                                                }}
                                            </template>
                                        </theory-countdown>
                                    </div>

                                    <div
                                        v-if="!counting"
                                        class="tw-text-md md:tw-text-xl"
                                    >
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
                                            מתוך 30 שאלות.
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
                                        <button
                                            class="tw-font-bold tw-w-full tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                                            @click="score"
                                            v-if="counting"
                                        >
                                            סיים מבחן
                                        </button>

                                        <button
                                            class="tw-font-bold tw-w-full tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                                            @click="restart"
                                            v-else
                                        >
                                            התחל מחדש
                                        </button>
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
                                    v-for="(i, n) in 30"
                                    class="tw-py-2 tw-my-1 tw-text-center tw-border tw-border-transparent tw-rounded tw-text-sm hover:tw-border-primary"
                                    style="width: 45%"
                                    @click="currentQuestion(n)"
                                    :class="{
                                        'tw-font-bold tw-border-primary tw-text-primary':
                                            i === currQuestion && counting,
                                        'tw-border-primary tw-bg-primary tw-line-through':
                                            i !== currQuestion &&
                                            quiz[n]['chosen_answer_id'] !==
                                                null &&
                                            counting,
                                        // score
                                        'tw-border-primary tw-bg-primary':
                                            !counting &&
                                            i !== currQuestion &&
                                            quiz[n]['chosen_answer_id'] !==
                                                null,
                                        'tw-text-green-700 tw-font-bold':
                                            !counting &&
                                            rightAnswer(n) ===
                                                quiz[n]['chosen_answer_id'],
                                        'tw-text-red-500 tw-font-bold':
                                            !counting &&
                                            rightAnswer(n) !==
                                                quiz[n]['chosen_answer_id'] &&
                                            quiz[n]['chosen_answer_id'] !==
                                                null,
                                        'tw-border-primary':
                                            i === currQuestion && !counting
                                    }"
                                >
                                    שאלה {{ i }}
                                </button>
                            </div>
                        </section>
                    </aside>
                </div>
            </template>

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
    name: "tests",

    data() {
        return {
            quiz: [],

            drivingLicenseType: null,

            questionIndex: 0,
            rightAnswersAmount: null,

            counting: true,
            time: 40 * 60 * 1000,
            progressBarStyle: {
                width: "100%"
            },

            startedDate: null,
            finishedDate: null,

            pressed: null
        };
    },

    methods: {
        restart() {
            this.fetchQuestions();

            this.quiz.forEach(quiz => {
                // clears the previous quiz's answered questions.
                quiz.chosen_answer_id = null;
            });

            this.questionIndex = 0;
            this.rightAnswersAmount = null;

            this.counting = true;

            if (this.$refs.countdown) {
                this.$refs.countdown.totalMilliseconds = this.time;
                this.$refs.countdown.start();
            }

            this.handleCountdownProgress({ totalMilliseconds: this.time });

            this.startedDate = new Date();
        },

        score() {
            if (!this.counting) {
                return;
            }

            this.questionIndex = 0;
            this.rightAnswersAmount = this.rightAnswers();

            this.$refs.countdown.totalMilliseconds = 0;
            this.handleCountdownProgress({ totalMilliseconds: 0 });

            this.counting = false;

            this.finishedDate = new Date();

            const payload = {
                started_at: this.startedDate,
                finished_at: this.finishedDate,
                driving_license_type_id: this.drivingLicenseType.id,
                answers: []
            };

            for (let i = 0; i < 30; i++) {
                payload.answers.push({
                    question_id: this.quiz[i].id,
                    answer_id: this.quiz[i].chosen_answer_id
                        ? this.quiz[i].answers[
                              this.quiz[i].chosen_answer_id - 1
                          ].id
                        : null
                });
            }

            this.$store.dispatch("storeTestReport", payload);

            if (!this.$store.getters.isLoggedIn) {
                alert("על מנת לשמור את המבחן, אנא הירשם/התחבר");
            }
        },

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
                if (this.quiz[question]["answers"][i]["is_correct"]) {
                    return i + 1;
                }
            }
        },

        rightAnswers() {
            let rightAnswers = 0;

            for (let i = 0; i < 30; i++) {
                if (
                    this.quiz[i]["chosen_answer_id"] !== null &&
                    this.rightAnswer(i) === this.quiz[i]["chosen_answer_id"]
                ) {
                    rightAnswers++;
                }
            }

            return rightAnswers;
        },

        handleCountdownProgress(data) {
            if (this.counting) {
                this.progressBarStyle = {
                    width: (data.totalMilliseconds / this.time) * 100 + "%"
                };
            }
        },

        fetchQuestions() {
            this.$axios
                .get(
                    `/driving-license-types/${this.$route.params.drivingLicenseType}/questions/random`
                )
                .then(response => {
                    let data = response.data;

                    data["questions"].forEach(function(currQuestion) {
                        currQuestion["chosen_answer_id"] = null;
                    });

                    this.quiz = data["questions"];

                    if (!this.drivingLicenseType) {
                        this.drivingLicenseType = data["driving_license_type"];
                    }
                })
                .catch(error => {
                    if (error.response.status === 404) {
                        this.$router.push({ name: "home" });
                    }
                });
        }
    },

    computed: {
        currQuestion() {
            return this.questionIndex + 1;
        },

        question() {
            return this.quiz[this.questionIndex];
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
            return Array.isArray(this.quiz) && this.quiz.length <= 0;
        }
    },

    created() {
        this.fetchQuestions();

        this.startedDate = new Date();
    }
};
</script>
