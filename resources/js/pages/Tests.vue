<template>
    <!--submit button will have a computed gradient-->
    <div class="tw-container tw-mx-auto tw-pt-10">
        <h1 class="tw-text-3xl tw-text-center">
            מבחן תאוריה - רכב פרטי (B)
        </h1>

        <div class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5">
            <div class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between tw-px-16" style="width: calc(100% - 300px)">
                <div>
                    <div v-if="questions">
                        {{quiz[questionIndex]['chosen_answer_id']}}
                        <div class="tw-text-2xl">
                            <span class="tw-text-3xl">{{ currQuestion }}.</span>
                            <span>{{ title }}</span>
                        </div>

                        <ul>
                            <!-- TODO: need to style it -->
                            <li v-for="(response, index) in answers">
                                <input type="radio" :name="'q_' + originalId" :id="'q_' + currQuestion + '_a_' + ++index" :value="index" v-model="quiz[questionIndex]['chosen_answer_id']">

                                <label :for="'q_' + currQuestion + '_a_' + index">
                                    {{ response['content'] }}
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
                quiz: fetch('/api/questions/random')
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function (currQuestion) {
                                currQuestion['chosen_answer_id'] = null;
                            });

                            this.quiz = data;
                        }),

                questionIndex: 0,
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

            lowerThanZero() {
                return this.questionIndex <= 0;
            },

            higherThanThirty() {
                return this.questionIndex >= 29;
            },
        },

        computed: {
            currQuestion() {
                return this.questionIndex + 1;
            },

            questions() {
                return this.quiz[this.questionIndex];
            },

            title() {
                return this.questions['title'];
            },

            answers() {
                return this.questions['answers'];
            },

            originalId() {
                return this.questions['original_id'];
            },
        }
    };

    let quiz = {};
</script>
