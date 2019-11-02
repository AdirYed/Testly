<template>
    <!--submit button will have a computed gradient-->
    <div id="tests-container" class="tw-container tw-mx-auto tw-pt-10">
        <h1 class="tw-text-3xl tw-text-center">
            מבחן תאוריה - רכב פרטי (B)
        </h1>

        <div id="theory-quiz" class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5">
            <div class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between tw-px-16" style="width: calc(100% - 300px)">
                <div>
                    <div>
                        <div class="tw-text-2xl">
                            <span class="tw-text-3xl">{{ currQuestion }}.</span>
                            {{ quiz.questions[questionIndex].text }}
                        </div>

                        <ul>
                            <!-- TODO: need to style it -->
                            <li v-for="(response, n) in quiz.questions[questionIndex].responses">
                                <input type="radio" :name="'q_' + currQuestion" :value="n" :id="'q_' + currQuestion + '_a_' + n" v-model="userResponses[currQuestion]">

                                <label :for="'q_' + currQuestion + '_a_' + n">
                                    {{ response.text }}
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <div class="tw-flex tw-flex-wrap tw-justify-between">
                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white" @click="prev()" :disabled="lowerThanZero()" :class="{'btn-disabled' : lowerThanZero()}">
                            <fa-icon icon="chevron-right" size="2x" />
                        </button>

                        <div class="tw-w-10/12 tw-px-2">
                            <!--submit button-->
                            <button class="btn tw-w-full tw-bg-primary tw-rounded tw-text-white">
                                סיים מבחן
                            </button>
                        </div>

                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white" @click="next()" :disabled="higherThanThirty()" :class="{'btn-disabled' : higherThanThirty()}">
                            <fa-icon icon="chevron-left" size="2x" />
                        </button>
                    </div>
                </div>
            </div>

            <aside style="direction: ltr">
                <!-- TODO: need to style it -->
                <section class="tw-flex tw-flex-wrap tw-justify-start tw-border tw-py-3 tw-rounded" style="width: 300px; direction: rtl; border-color: rgba(0, 0, 0, 0.25);">
                    <div v-for="(i, n) in 30" class="tw-py-1 tw-w-1/3 tw-text-center">
                        <button class="tw-p-2" @click="currentQuestion(n)">
                            שאלה {{ i }}
                        </button>
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

        data() {
            return {
                quiz: quiz,

                questionIndex: 0,

                userResponses: Array(quiz.questions.length).fill(false),
            }
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

            score() {
                return this.userResponses.filter(function(val) { return val }).length;
            },

            lowerThanZero() {
                return this.questionIndex <= 0;
            },

            higherThanThirty() {
                return this.questionIndex >= 29;
            }
        },

        computed: {
            currQuestion() {
                return this.questionIndex + 1
            },
        }
    };

    const quiz = {
        questions: [
            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },            {
                text: "What is the full form of HTTP?",
                responses: [
                    { text: "Hyper text transfer package" },
                    { text: "Hyper text transfer protocol", correct: true },
                    { text: "Hyphenation text test program" },
                    { text: "None of the above" }
                ]
            },

            {
                text: "HTML document start and end with which tag pairs?",
                responses: [
                    { text: "HTML", correct: true },
                    { text: "WEB" },
                    { text: "HEAD" },
                    { text: "BODY" }
                ]
            },

            {
                text: "Which tag is used to create body text in HTML?",
                responses: [
                    { text: "HEAD" },
                    { text: "BODY", correct: true },
                    { text: "TITLE" },
                    { text: "TEXT" }
                ],
            },
        ]
    };
</script>
