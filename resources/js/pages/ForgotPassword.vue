<template>
  <div class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10">
    <vue-headful
      description="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי! שכחת את סיסמתך?"
      title="טסטלי - מבחני תאוריה - איפוס סיסמה"
    />

    <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
      שכחת את הסיסמה?
    </div>

    <div
      class="tw-w-full tw-max-w-2xl tw-text-lg tw-pt-5 tw-text-center tw-mx-auto"
    >
      אם שכחת את סיסמתך וברצונך לאפס אותה, הינך יכול למלא טופס זה ולקבל הוראות
      באימייל כיצד לאפס את הסיסמה.
    </div>

    <div class="tw-w-full tw-max-w-xs tw-mx-auto tw-pt-5">
      <form
        @submit.prevent="forgotPassword"
        class="tw-rounded tw-px-8"
        method="post"
      >
        <div class="tw-mb-5">
          <label
            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
            for="email"
          >
            אימייל
          </label>
          <input
            :class="{ 'tw-border-red-500': errors.email }"
            @input="deleteError('email')"
            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
            id="email"
            maxLength="50"
            placeholder="אימייל"
            type="email"
            v-model="auth.email"
          />

          <div
            class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
            v-if="errors.email"
          >
            {{ errors.email[0] }}
          </div>
        </div>

        <div class="tw-my-3">
          <div
            class="tw-container tw-mx-auto tw-flex tw-justify-center"
            style="height: 18px"
            v-if="isLoading"
          >
            <theory-pulse-loader
              :loading="isLoading"
              class=""
              color="var(--primary-color)"
              size="0.75rem"
            />
          </div>
        </div>

        <div class="tw-flex tw-flex-wrap tw-flex-col">
          <button
            class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
            type="submit"
          >
            שלח בקשה
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "forgot-password",

  data() {
    return {
      auth: {
        email: ""
      },

      isLoading: false,

      errors: {}
    };
  },

  methods: {
    deleteError(property) {
      this.errors[property] = null;
    },

    forgotPassword() {
      if (this.isLoading) {
        return;
      }

      this.isLoading = true;

      this.$axios
        .post("forgot-password", this.auth)
        .then(() => {
          this.$toast("איפוס סיסמה נשלח לאימייל.");

          this.$router.push("/");
        })
        .catch(err => {
          if (err.response.status === 422 && err.response.data.errors) {
            this.errors = err.response.data.errors;
          }

          this.isLoading = false;
        });
    }
  }
};
</script>
