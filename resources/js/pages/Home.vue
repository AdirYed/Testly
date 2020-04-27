<template>
  <div>
    <vue-headful
      description="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי!"
      title="טסטלי - מבחני תאוריה"
    />

    <div
      class="tw-flex tw-flex-col tw-items-center tw-justify-center"
      id="home-img-section"
      style="padding-bottom: var(--header-height);"
    >
      <div class="tw-flex tw-items-center tw-justify-center">
        <div
          class="testly-icon tw-w-12 md:tw-w-16 tw-h-12 md:tw-h-16 tw-ml-1"
        />
        <div
          class="tw-text-4xl md:tw-text-5xl tw-text-primary tw-font-semibold"
        >
          טסטלי
        </div>
      </div>

      <h1 class="tw-text-2xl md:tw-text-3xl tw-text-center tw-text-white">
        דימוי מבחני תאוריה בחינם!
      </h1>

      <div class="tw-text-center tw-mt-5">
        <button
          @click="readMore()"
          class="btn tw-py-1 md:tw-py-2 tw-px-3 md:tw-px-4 tw-border-2 tw-border-primary tw-text-primary tw-rounded"
        >
          גש למבחן
        </button>
      </div>
    </div>

    <div class="tw-container tw-mx-auto" id="choose-a-test" ref="testOptions">
      <div class="tw-px-4 tw-py-8">
        <h1 class="tw-text-xl md:tw-text-3xl tw-break-words">
          <template v-if="!$store.getters.isLoggedIn">
            כדאי
            <router-link :to="{ name: 'register' }" class="link"
              >להירשם</router-link
            >
            לטסטלי כדי לשמור את היסטוריית המבחנים ואת קצב ההתקדמות שלך.
          </template>
          <template v-else>
            שלום
            <router-link :to="{ name: 'dashboard' }" class="link">{{
              $store.state.user.first_name
            }}</router-link>
            , איזה מבחן נעשה היום?
          </template>
        </h1>
      </div>

      <div class="tw-text-center tw-font-semibold">
        <h1 class="tw-text-2xl md:tw-text-4xl">
          מבחנים
        </h1>
      </div>

      <section
        class="tw-w-full tw-flex tw-flex-wrap tw-justify-center"
        v-if="$store.state.drivingLicenseTypes"
      >
        <div
          :key="index"
          class="tw-p-2 sm:tw-p-4"
          v-for="(test, index) in $store.state.drivingLicenseTypes"
        >
          <theory-card
            :params="{ drivingLicenseType: test.code }"
            :src="test.image_url"
            to="tests"
          >
            <template class="tw-text-center" slot="title">
              <fa-icon
                :icon="test.icon"
                class="fa-fw tw-inline md:tw-hidden"
                v-if="test.icon"
              />
              {{ test.name }} ({{ test.code }})
            </template>
            כל השאלות והתשובות מהמאגר למבחן נהיגה עיוני ממוחשב ל{{
              test.name
            }}
            ({{ test.code }})
            <template slot="button-desc">למבחן תאוריה</template>
          </theory-card>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import Card from "../components/Card";

async function scrollBehavior() {
  if (!("scrollBehavior" in document.documentElement.style)) {
    await import("scroll-behavior-polyfill");
  }
}

export default {
  name: "home",

  components: {
    "theory-card": Card,
  },

  methods: {
    readMore() {
      window.scrollTo({
        top: this.$refs.testOptions.offsetTop,
        behavior: "smooth",
      });
    },
  },

  created() {
    scrollBehavior();
  },
};
</script>

<style scoped>
#choose-a-test {
  margin-top: calc(var(--header-height) * -1 + 2px);
  padding-top: var(--header-height);
}

@media (hover: hover) and (pointer: fine) {
  .btn:hover {
    @apply tw-text-white tw-bg-primary;
  }
}

.btn:active {
  @apply tw-text-white tw-bg-primary;
}
</style>
