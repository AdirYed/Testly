<template>
    <!--submit button will have a computed gradient-->
    <div class="tw-container tw-mx-auto tw-pt-10 tw-px-10">
        <h1 class="tw-flex tw-flex-wrap tw-justify-between tw-text-center tw-items-center">
            <div class="tw-w-10/12 tw-text-3xl">
                מבחן תאוריה - רכב פרטי (B)
            </div>

            <div class="tw-w-2/12">
                <button class="tw-text-sm tw-border tw-rounded tw-p-2" style="border-color: rgba(0, 0, 0, 0.25);" @click="restart">
                    התחל מחדש
                </button>
            </div>
        </h1>

        <div v-if="question" class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5 tw-break-words">
            <div class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between tw-pl-16 tw-w-10/12">
                <div>
                    <div class="tw-text-2xl">
                        <span class="tw-text-3xl">{{ currQuestion }}.</span>
                        {{ title }}
                    </div>

                    <ul class="tw-flex tw-flex-wrap tw-flex-col tw--my-1 tw-mt-1">
                        <li class="tw-w-full tw-py-1" v-for="(response, index) in answers">
                            <label class="tw-block tw-p-2 tw-border tw-border-transparent tw-rounded tw-cursor-pointer tw-w-full"
                                :class="{
                                'hover:tw-border-primary hover:tw-text-primary' : question['chosen_answer_id'] !== ++index && counting,
                                'tw-bg-primary' : question['chosen_answer_id'] === index,
                                // score
                                'tw-text-green-700 tw-font-bold tw-border-primary' : !counting && response['is_correct'],
                                'tw-text-red-500 tw-font-bold' : !counting && !response['is_correct'] && question['chosen_answer_id'] === index,
                                }" :for="'q_' + currQuestion + '_a_' + index"> <!--rightAnswer(questionIndex) - aims only for the right answer-->

                                <input class="tw-opacity-0 tw-h-0 tw-w-0" type="radio" :name="'q_' + questionId" :id="'q_' + currQuestion + '_a_' + index" :key="'q_' + currQuestion + '_a_' + index" :value="index" v-model="question['chosen_answer_id']" @change="next()" :disabled="!counting">

                                {{ response['content'] }}
                            </label>
                        </li>
                    </ul>

                    <div v-if="img" class="tw-my-2">
                        <div class="questioning-img tw-mx-auto tw-h-48 tw-my-3" :style="{ 'background-image': 'url(/storage/' + img + ')' }"></div>
                    </div>
                </div>

                <div>
                    <div class="tw-flex tw-flex-wrap tw-flex-col">
                        <div class="tw-mx-auto tw-mb-2 tw-max-w-24 tw-text-center">
                            <div class="tw-border-2 tw-border-primary tw-rounded tw-py-3 tw-px-4 tw-text-xl" v-if="counting">
                                <theory-countdown :time="time" @progress="handleCountdownProgress" @end="score">
                                    <template slot-scope="props">{{ props.minutes }}:{{ props.seconds }}</template>
                                </theory-countdown>
                            </div>

                            <div v-if="!counting" class="tw-text-xl">
                                <div class="tw-border tw-border-transparent tw-p-4 tw-rounded" :class="{ 'tw-border-green-700' : rightAnswersAmount >= 28, 'tw-border-red-500' : rightAnswersAmount < 28 }">
                                    <div>
                                        <template v-if="rightAnswersAmount >= 28">
                                            עברת את המבחן בהצלחה!
                                        </template>

                                        <template v-else>
                                            נכשלת במבחן...
                                        </template>
                                    </div>

                                    ענית נכון על
                                    <span>{{ rightAnswersAmount }}</span>
                                    מתוך 30 שאלות.
                                </div>
                            </div>
                        </div>

                        <div class="tw-flex tw-flex-wrap tw-justify-between">
                            <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary" @click="prev()" :disabled="lowerThanZero()" :class="{'btn-disabled' : lowerThanZero()}">
                                <fa-icon icon="chevron-right" size="2x" />
                            </button>

                            <div class="tw-w-10/12 tw-px-2">
                                <button class="btn tw-w-full tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary" @click="score">
                                    סיים מבחן
                                </button>
                            </div>

                            <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary" @click="next()" :disabled="higherThanThirty()" :class="{'btn-disabled' : higherThanThirty()}">
                                <fa-icon icon="chevron-left" size="2x" />
                            </button>

                            <div class="tw-h-1 tw-bg-red-500" style="transition: .2s ease-in-out" :style="progressBarStyle"></div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="tw-w-2/12" style="direction: ltr">
                <section class="tw-border tw-py-3 tw-rounded" style="direction: rtl; border-color: rgba(0, 0, 0, 0.25);">
                    <div class="tw-flex tw-flex-wrap tw-justify-between tw-mx-auto" style="width: 90%">
                        <button v-for="(i, n) in 30" class="tw-py-2 tw-my-1 tw-text-center tw-border tw-border-transparent tw-rounded tw-text-sm hover:tw-border-primary" style="width: 45%" @click="currentQuestion(n)"
                                :class="{
                                'tw-font-bold tw-border-primary tw-text-primary' : i === currQuestion && counting,
                                'tw-border-primary tw-bg-primary tw-line-through' : i !== currQuestion && quiz[n]['chosen_answer_id'] !== null && counting,
                                // score
                                'tw-border-primary tw-bg-primary' : !counting && i !== currQuestion && quiz[n]['chosen_answer_id'] !== null,
                                'tw-text-green-700 tw-font-bold' : !counting && rightAnswer(n) === quiz[n]['chosen_answer_id'],
                                'tw-text-red-500 tw-font-bold' : !counting && rightAnswer(n) !== quiz[n]['chosen_answer_id'] && quiz[n]['chosen_answer_id'] !== null,
                                'tw-border-primary' : i === currQuestion && !counting,
                                 }">
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
                quiz: fetch('/api/questions/random')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (currQuestion) {
                            currQuestion['chosen_answer_id'] = null;
                        });

                        this.quiz = data;
                    }),

                backupQuiz: fetch('/api/questions/random')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (currQuestion) {
                            currQuestion['chosen_answer_id'] = null;
                        });

                        this.backupQuiz = data;
                    }),

                questionIndex: 0,
                rightAnswersAmount: null,

                counting: true,
                time: 40 * 60 * 1000,
                progressBarStyle: {
                    width: '100%',
                },
            }
        },

        methods: {
            restart() {
                this.quiz = this.backupQuiz;

                this.questionIndex = 0;
                this.rightAnswersAmount = null;

                this.counting = true;

                this.backupQuiz = fetch('/api/questions/random')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (currQuestion) {
                            currQuestion['chosen_answer_id'] = null;
                        });

                        this.backupQuiz = data;
                    });
            },

            score() {
                this.questionIndex = 0;
                this.rightAnswersAmount = this.rightAnswers();

                this.counting = false;

                this.handleCountdownProgress({totalMilliseconds: 0});
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
                    if (this.quiz[question]['answers'][i]['is_correct']) {
                        return i + 1;
                    }
                }
            },

            rightAnswers() {
                let rightAnswers = 0;

                for (let i = 0; i < 30; i++) {
                    if (this.quiz[i]['chosen_answer_id'] !== null && this.rightAnswer(i) === this.quiz[i]['chosen_answer_id']) {
                        rightAnswers++;
                    }
                }

                return rightAnswers;
            },

            handleCountdownProgress(data) {
                this.progressBarStyle = {
                    width: (data.totalMilliseconds / this.time) * 100 + '%',
                };
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
                return this.question['title'];
            },

            answers() {
                return this.question['answers'];
            },

            img() {
                return this.question['image_url'];
            },

            questionId() {
                return this.question['id'];
            },
        }
    };
</script>
