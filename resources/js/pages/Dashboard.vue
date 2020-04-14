<template>
  <div class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10">
    <vue-headful title="טסטלי - מבחני תאוריה - הפרופיל שלי" />

    <div
      class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center tw-mb-5 tw-break-words"
    >
      {{ $store.state.user.first_name }}
      {{ $store.state.user.last_name }}
    </div>

    <div
      class="tw-container tw-mx-auto tw-flex tw-justify-center"
      v-if="isLoading"
    >
      <theory-pulse-loader
        :loading="isLoading"
        class="tw-absolute"
        color="var(--primary-color)"
        size="40px"
        style="top: 50%;"
      />
    </div>

    <template v-else-if="!isLoading && testReports.length !== 0">
      <div class="tw-mb-5 tw-m-auto" v-if="chartDataOptions">
        <div class="tw-text-lg md:tw-text-2xl tw-text-center">
          רמת מוכנות -
          {{ Math.floor(chartPercentage) }}%
        </div>

        <theory-line-chart
          :data="chartData"
          :options="chartDataOptions"
          class="tw-h-56 md:tw-h-64 lg:tw-h-80"
          ref="chart"
        />

        <div class="tw-text-xs tw-text-gray-700 tw-text-center">
          *לפי עשרת המבחנים האחרונים
        </div>
      </div>

      <div class="tw-text-center tw-mb-5" v-if="percentage.length > 0">
        <div class="tw-text-lg md:tw-text-2xl">
          אחוז מוכנות
        </div>

        <div
          class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-w-8/12 md:tw-w-7/12 lg:tw-w-6/12 tw-mx-auto"
        >
          <div
            class="tw-w-8/12 md:tw-w-7/12 lg:tw-w-6/12 tw-my-3"
            v-for="category in categories"
            v-if="percentage[category.id] || percentage[category.id] === 0"
          >
            <div class="tw-text-md md:tw-text-lg">
              {{ category.name }}
              -
              {{ Math.floor(percentage[category.id]) }}%
            </div>

            <div class="tw-bg-gray-300 tw-mt-2">
              <div
                :style="'width: ' + percentage[category.id] + '%'"
                class="progressBar"
              ></div>
            </div>
          </div>
        </div>

        <div class="tw-text-xs tw-text-gray-700 tw-text-center">
          *לפי חמשת המבחנים האחרונים ללא אופניים חשמליים (A3)
        </div>
      </div>

      <div>
        <div class="tw-text-lg md:tw-text-2xl tw-mb-5 tw-text-center">
          היסטוריית מבחנים
        </div>

        <table
          class="tw-w-full tw-flex sm:tw-bg-white tw-rounded-lg sm:tw-shadow-lg"
        >
          <thead class="tw-text-white">
            <tr
              class="tw-bg-primary tw-flex tw-wrap tw-flex-col sm:tw-table-row tw-rounded-l-lg sm:tw-rounded-none tw-mb-2 sm:tw-mb-0 tw-text-sm md:tw-text-base"
              v-for="i in testReports.length"
            >
              <th class="tw-p-2 sm:tw-p-3 sm:tw-w-2/12">
                רישיון
              </th>
              <th class="tw-p-2 sm:tw-p-3 sm:tw-w-2/12">תאריך</th>
              <th class="tw-p-2 sm:tw-p-3 sm:tw-w-2/12">
                תשובות נכונות
              </th>
              <th class="tw-p-2 sm:tw-p-3 sm:tw-w-2/12">זמן</th>
              <th class="tw-p-2 sm:tw-p-3 sm:tw-w-2/12">צפייה</th>
            </tr>
          </thead>

          <tbody class="tw-flex-1 sm:tw-flex-none">
            <tr
              :key="testReport.id"
              class="tw-flex tw-wrap tw-flex-col sm:tw-table-row tw-mb-2 sm:tw-mb-0 tw-text-sm md:tw-text-base"
              v-for="testReport in testReports"
            >
              <td class="tw-border-grey-light tw-border tw-p-2 sm:tw-p-3">
                <fa-icon
                  :icon="testReport.driving_license_type.icon"
                  class="fa-fw"
                  v-if="testReport.driving_license_type.icon"
                />
                {{ testReport.driving_license_type.name }}
                ({{ testReport.driving_license_type.code }})
              </td>

              <td class="tw-border-grey-light tw-border tw-p-2 sm:tw-p-3">
                {{ date(testReport.finished_at) }}
              </td>

              <td class="tw-border-grey-light tw-border tw-p-2 sm:tw-p-3">
                {{ testReport.correct_answers_count }}/30
              </td>

              <td class="tw-border-grey-light tw-border tw-p-2 sm:tw-p-3">
                {{ minutes(testReport.finished_at - testReport.started_at) }}
                דקות
              </td>

              <td class="tw-border tw-p-2 sm:tw-p-3 tw-font-semibold">
                <router-link
                  :to="{
                    name: 'test-result',
                    params: { uuid: testReport.uuid }
                  }"
                  class="link"
                >
                  צפייה במבחן
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>

    <template v-else>
      <div class="tw-text-lg md:tw-text-2xl tw-mb-5">
        הפרופיל כרגע ריק משום שאין לך היסטוריית
        <router-link :to="{ name: 'home', hash: '#choose-a-test' }" class="link"
          >מבחנים
        </router-link>
        .
      </div>
    </template>
  </div>
</template>

<script>
import LineChart from "../components/LineChart";

export default {
  name: "dashboard",

  components: {
    "theory-line-chart": LineChart
  },

  data() {
    return {
      testReports: [],
      isLoading: true,
      testReportErrors: false,
      categoriesErrors: false,

      categories: null,

      percentage: null,

      chartData: {
        labels: [],
        datasets: []
      },
      chartDataOptions: null,
      chartPercentage: null
    };
  },

  created() {
    this.init();
  },

  methods: {
    init() {
      this.isLoading = true;
      this.testReportErrors = false;
      this.categoriesErrors = false;

      this.$store
        .dispatch("fetchTestReports")
        .then(response => {
          this.testReports = response.data;

          this.testReports.forEach(function(testReport) {
            testReport.started_at = Date.parse(testReport.started_at);
            testReport.finished_at = Date.parse(testReport.finished_at);
          });

          this.calcPercentage();

          if (this.testReports.length > 1) {
            this.fillData();
          }

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

    fillData() {
      this.chartData.datasets.push({
        label: "תשובות נכונות",
        borderColor: "#f5af19",
        backgroundColor: "transparent",
        pointBackgroundColor: "#f5af19",
        borderWidth: 3,
        pointRadius: 2,
        data: []
      });

      this.chartDataOptions = {
        maintainAspectRatio: false,
        legend: {
          rtl: true,
          labels: {
            fontSize: 16
          }
        },
        scales: {
          yAxes: [
            {
              gridLines: {
                zeroLineColor: "#bbb"
              },
              ticks: {
                min: 0,
                max: 30
              }
            }
          ],
          xAxes: [
            {
              gridLines: {
                zeroLineColor: "transparent"
              },
              ticks: {
                maxTicks: 0,
                display: false
              }
            }
          ]
        }
      };

      let till = 10;
      let percentage = 0;

      if (this.testReports.length < till) {
        till = this.testReports.length;
      }

      for (let i = till - 1; i >= 0; i--) {
        this.chartData.labels.push(
          this.date(this.testReports[i].finished_at).replace(/\s+/g, " ")
        );

        this.chartData.datasets[0].data.push(
          this.testReports[i].correct_answers_count
        );

        percentage += this.testReports[i].correct_answers_count;
      }

      this.chartPercentage = (percentage / till / 30) * 100;
    },

    calcPercentage() {
      let categories = [];
      let counter = [];

      this.testReports.forEach(function(item) {
        if (!item.success_by_categories) {
          return;
        }

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
      // Example: 06:13 minutes
      const date = new Date(ms);

      return `${this.appendLeadingZeroes(
        date.getMinutes()
      )}:${this.appendLeadingZeroes(date.getSeconds())}`;
    },

    date(ms) {
      // Example: 02/12/2019 - 17:00 (ltr)
      const date = new Date(ms);

      return `${this.appendLeadingZeroes(
        date.getDate()
      )}/${this.appendLeadingZeroes(date.getMonth() + 1)}/${date.getFullYear()}
            -
            ${this.appendLeadingZeroes(
              date.getHours()
            )}:${this.appendLeadingZeroes(date.getMinutes())}`;
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

<style scoped>
@media (min-width: 640px) {
  table {
    display: inline-table !important;
  }

  thead tr:not(:first-child) {
    display: none;
  }
}

td:not(:last-child) {
  border-bottom: 0;
}

@media (max-width: 640px) {
  th:not(:last-child) {
    border-bottom: 1.5px solid rgba(0, 0, 0, 0.1);
  }
}
</style>
