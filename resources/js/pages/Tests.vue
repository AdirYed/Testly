<template>
  <div>
    <div
      :style="progressBarStyle"
      class="progressBar progressBarTransition tw-fixed"
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

        <div class="tw-hidden md:tw-block tw-w-2/12" v-if="drivingLicenseType">
          <button
            @click="restart"
            class="tw-text-sm tw-border tw-rounded tw-p-2"
            style="border-color: rgba(0, 0, 0, 0.25);"
          >
            התחל מחדש
          </button>
        </div>
      </h1>

      <template v-if="!isLoading && drivingLicenseType">
        <vue-headful
          :description="
            'טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי! מבחן ' +
              drivingLicenseType.name +
              ' (' +
              drivingLicenseType.code +
              ') בטסטלי'
          "
          :title="
            'טסטלי - מבחני תאוריה - מבחן ' +
              drivingLicenseType.name +
              ' (' +
              drivingLicenseType.code +
              ')'
          "
        />

        <div
          class="tw-flex tw-flex-wrap tw-flex-row tw-justify-between tw-pt-5 tw-break-words tw-h-full"
          v-if="question"
        >
          <div
            class="tw-flex tw-flex-wrap tw-flex-col tw-justify-between lg:tw-pl-16 lg:tw-w-9/12 xl:tw-w-10/12 tw-w-full"
          >
            <div>
              <div class="tw-font-medium tw-text-lg md:tw-text-2xl">
                <span class="tw-text-xl md:tw-text-3xl"
                  >{{ currQuestion }}.</span
                >
                {{ title }}
              </div>

              <ul class="tw-flex tw-flex-wrap tw-flex-col tw--my-1 tw-mt-1">
                <li
                  class="tw-w-full tw-py-1"
                  v-for="(response, index) in answers"
                >
                  <label
                    :class="{
                      'options tw-cursor-pointer':
                        question['chosen_answer_id'] !== ++index && counting,
                      'tw-bg-primary': question['chosen_answer_id'] === index,
                      // score
                      'tw-text-green-700 tw-font-bold md:tw-border-primary':
                        !counting && response['is_correct'],
                      'tw-text-red-500 tw-font-bold':
                        !counting &&
                        !response['is_correct'] &&
                        question['chosen_answer_id'] === index
                    }"
                    :for="'q_' + currQuestion + '_a_' + index"
                    :key="'q_' + currQuestion + '_a_' + index"
                    class="tw-block tw-p-2 tw-border tw-rounded tw-w-full md:tw-border-transparent tw-border-primary md:tw-text-base tw-text-sm"
                  >
                    <!-- rightAnswer(questionIndex) - aims only for the right answer-->

                    <input
                      :disabled="!counting"
                      :id="'q_' + currQuestion + '_a_' + index"
                      :key="'q_' + currQuestion + '_a_' + index"
                      :name="'q_' + questionId"
                      :value="index"
                      @change="next()"
                      class="tw-opacity-0 tw-h-0 tw-w-0"
                      type="radio"
                      v-model="question['chosen_answer_id']"
                    />
                    {{ response["content"] }}
                  </label>
                </li>
              </ul>

              <div class="tw-my-2" v-if="img">
                <div
                  :style="{
                    'background-image': 'url(' + img + ')'
                  }"
                  class="questioning-img tw-mx-auto tw-h-32 lg:tw-h-48 tw-my-3"
                ></div>
              </div>
            </div>

            <div>
              <div class="tw-flex tw-flex-wrap tw-flex-col">
                <div class="tw-mx-auto tw-my-2 tw-max-w-24 tw-text-center">
                  <div
                    :class="{
                      'tw-border-2 tw-border-primary tw-rounded tw-py-3 tw-px-4 tw-text-md md:tw-text-xl': counting
                    }"
                  >
                    <theory-countdown
                      :time="time"
                      @end="score"
                      @progress="handleCountdownProgress"
                      ref="countdown"
                      v-show="counting"
                    >
                      <template slot-scope="props">
                        {{ props.minutes }}:{{ props.seconds }}
                      </template>
                    </theory-countdown>
                  </div>

                  <div class="tw-text-md md:tw-text-xl" v-if="!counting">
                    <div
                      :class="{
                        'tw-border-green-700': rightAnswersAmount >= 26,
                        'tw-border-red-500': rightAnswersAmount < 26
                      }"
                      class="tw-border tw-border-transparent tw-p-4 tw-rounded"
                    >
                      <div>
                        <template v-if="rightAnswersAmount >= 26">
                          עברת את המבחן בהצלחה!
                        </template>

                        <template v-else>
                          נכשלת במבחן...
                        </template>
                      </div>

                      ענית נכון על
                      <span>{{ rightAnswersAmount }}</span>
                      מתוך
                      {{ quiz.length }}
                      שאלות.
                    </div>
                  </div>
                </div>

                <div
                  class="tw-flex tw-flex-wrap tw-justify-between md:tw-h-full"
                >
                  <button
                    :class="{
                      'btn-disabled': lowerThanZero()
                    }"
                    :disabled="lowerThanZero()"
                    @click="prev()"
                    class="tw-w-2/12 lg:tw-w-1/12 tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                  >
                    <fa-icon
                      class="tw-text-2xl md:tw-text-3xl"
                      icon="chevron-right"
                    />
                  </button>

                  <div class="tw-w-8/12 lg:tw-w-10/12 tw-px-2">
                    <button
                      @click="score"
                      class="tw-font-bold tw-w-full tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                      v-if="counting"
                    >
                      סיים מבחן
                    </button>

                    <button
                      @click="restart"
                      class="tw-font-bold tw-w-full tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
                      v-else
                    >
                      התחל מחדש
                    </button>
                  </div>

                  <button
                    :class="{
                      'btn-disabled': higherThanThirty()
                    }"
                    :disabled="higherThanThirty()"
                    @click="next()"
                    class="tw-w-2/12 lg:tw-w-1/12 tw-h-10 md:tw-h-12 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
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
                  :class="{
                    'tw-font-bold tw-border-primary tw-text-primary':
                      i === currQuestion && counting,
                    'tw-border-primary tw-bg-primary tw-line-through':
                      i !== currQuestion &&
                      quiz[n]['chosen_answer_id'] !== null &&
                      counting,
                    // score
                    'tw-border-primary tw-bg-primary':
                      !counting &&
                      i !== currQuestion &&
                      quiz[n]['chosen_answer_id'] !== null,
                    'tw-text-green-700 tw-font-bold':
                      !counting &&
                      rightAnswer(n) === quiz[n]['chosen_answer_id'],
                    'tw-text-red-500 tw-font-bold':
                      !counting &&
                      rightAnswer(n) !== quiz[n]['chosen_answer_id'] &&
                      quiz[n]['chosen_answer_id'] !== null,
                    'tw-border-primary': i === currQuestion && !counting
                  }"
                  @click="currentQuestion(n)"
                  class="questions tw-py-2 tw-my-1 tw-text-center tw-border tw-border-transparent tw-rounded tw-text-sm"
                  style="width: 45%"
                  v-for="(i, n) in quiz.length"
                >
                  שאלה {{ i }}
                </button>
              </div>
            </section>
          </aside>
        </div>
      </template>

      <div class="tw-pt-5" v-else-if="drivingLicenseType === false">
        <vue-headful
          description="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי! לא נמצא מבחן בטסטלי."
          title="טסטלי - מבחני תאוריה - שגיאה"
        />

        <div class="tw-text-xl">
          רישיון זה אינו קיים, נא לבחור אחד
          <router-link
            :to="{ name: 'home', hash: '#choose-a-test' }"
            class="link"
          >
            מהרישיונות
          </router-link>
          הקיימים בלבד.
        </div>
      </div>

      <div class="tw-container tw-mx-auto tw-flex tw-justify-center" v-else>
        <theory-pulse-loader
          :loading="isLoading"
          class="tw-absolute"
          color="var(--primary-color)"
          size="40px"
          style="top: 50%;"
        />
      </div>
    </div>
  </div>
</template>

<script>
import SaveTest from "../components/SaveTest";
import VueCountdown from "@chenfengyuan/vue-countdown";

export default {
  name: "tests",

  components: {
    "theory-countdown": VueCountdown
  },

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

      saveTestNotification: false
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

      for (let i = 0; i < this.quiz.length; i++) {
        payload.answers.push({
          question_id: this.quiz[i].id,
          answer_id: this.quiz[i].chosen_answer_id
            ? this.quiz[i].answers[this.quiz[i].chosen_answer_id - 1].id
            : null
        });
      }

      this.$store.dispatch("storeTestReport", payload);

      if (!this.$store.getters.isLoggedIn && !this.saveTestNotification) {
        this.$toast(SaveTest);
        this.saveTestNotification = true;
      }

      this.$ga.event(
        "Tests",
        "Complete Test",
        this.drivingLicenseType.code,
        this.rightAnswersAmount
      );
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

          this.$ga.event("Tests", "Start Test", this.drivingLicenseType.code);
        })
        .catch(error => {
          if (
            error.response.status === 422 &&
            error.response.data.error === "driving_license_type"
          ) {
            this.drivingLicenseType = false;
          }
        });
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

      for (let i = 0; i < this.quiz.length; i++) {
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

<style scoped>
@media (hover: hover) and (pointer: fine) {
  .options:hover {
    @apply border-primary text-primary;
  }

  .questions:hover {
    @apply border-primary;
  }
}

.options:active {
  @apply border-primary text-primary;
}

.questions:active {
  @apply border-primary;
}
</style>
