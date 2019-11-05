<template>
    <!--submit button will have a computed gradient-->
    <div class="tw-container tw-mx-auto tw-pt-10 tw-px-10">
        <h1 class="tw-text-3xl tw-text-center">
            מבחן תאוריה - רכב פרטי (B)
        </h1>

        <div v-if="question" class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5 tw-break-words">
            <div class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between tw-pl-16" style="width: calc(100% - 200px);">
                <div>
                    <div class="tw-text-2xl">
                        <span class="tw-text-3xl">{{ currQuestion }}.</span>
                        {{ title }}
                    </div>

                    <ul class="tw-flex tw-flex-wrap tw-flex-col tw--my-1 tw-mt-1">
                        <li class="tw-w-full tw-py-1" v-for="(response, index) in answers">
                            <label class="tw-inline-block tw-p-2 tw-border tw-border-transparent tw-rounded tw-cursor-pointer tw-w-full"
                                :class="{ 'hover:tw-border-primary hover:tw-text-primary' : question['chosen_answer_id'] !== ++index,
                                'tw-bg-primary' : question['chosen_answer_id'] === index }" :for="'q_' + currQuestion + '_a_' + index">
                                <input class="tw-opacity-0 tw-h-0 tw-w-0" type="radio" :name="'q_' + originalId" :id="'q_' + currQuestion + '_a_' + index" :key="'q_' + currQuestion + '_a_' + index" :value="index" v-model="question['chosen_answer_id']" @change="next()">

                                {{ response['content'] }}
                            </label>
                        </li>
                    </ul>

                    <div v-if="img" class="tw-my-2">
                        <div class="questioning-img tw-mx-auto tw-h-48 tw-my-3" :style="{ 'background-image': 'url(/storage/' + img + ')' }"></div>
                    </div>
                </div>

                <div>
                    <div class="tw-flex tw-flex-wrap tw-justify-between">
                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary" @click="prev()" :disabled="lowerThanZero()" :class="{'btn-disabled' : lowerThanZero()}">
                            <fa-icon icon="chevron-right" size="2x" />
                        </button>

                        <div class="tw-w-10/12 tw-px-2">
                            <!--submit button-->
                            <button class="btn tw-w-full tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary">
                                סיים מבחן
                            </button>
                        </div>

                        <button class="tw-w-1/12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary" @click="next()" :disabled="higherThanThirty()" :class="{'btn-disabled' : higherThanThirty()}">
                            <fa-icon icon="chevron-left" size="2x" />
                        </button>
                    </div>
                </div>
            </div>

            <aside style="direction: ltr">
                <section class="tw-border tw-py-3 tw-rounded" style="width: 200px; direction: rtl; border-color: rgba(0, 0, 0, 0.25);">
                    <div class="tw-flex tw-flex-wrap tw-justify-between tw-mx-auto" style="width: 90%">
                        <button v-for="(i, n) in 30" class="tw-py-2 tw-my-1 tw-text-center tw-border tw-border-transparent tw-rounded tw-text-sm hover:tw-border-primary" style="width: 45%" @click="currentQuestion(n)" :class="{'tw-font-bold tw-border-primary tw-text-primary' : i === currQuestion, 'tw-border-primary tw-bg-primary tw-line-through' : i !== currQuestion && quiz[n]['chosen_answer_id'] !== null}">
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

            originalId() {
                return this.question['original_id'];
            },
        }
    };
</script>
