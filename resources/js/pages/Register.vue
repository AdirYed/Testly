<template>
  <div class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10">
    <vue-headful
      description="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי! הירשם לטסטלי."
      title="טסטלי - מבחני תאוריה - הרשמה"
    />

    <div
      class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center tw-mb-5"
    >
      הירשם
    </div>

    <div class="tw-w-full tw-max-w-xs tw-mx-auto">
      <form @submit.prevent="register" class="tw-rounded tw-px-8" method="post">
        <div class="tw-mb-5">
          <label
            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
            for="first_name"
          >
            שם פרטי
          </label>
          <input
            :class="{ 'tw-border-red-500': errors.first_name }"
            @input="deleteError('first_name')"
            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
            id="first_name"
            maxlength="20"
            placeholder="שם פרטי"
            type="text"
            v-model="auth.first_name"
          />

          <div
            class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
            v-if="errors.first_name"
          >
            {{ errors.first_name[0] }}
          </div>
        </div>

        <div class="tw-mb-5">
          <label
            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
            for="last_name"
          >
            שם משפחה
          </label>
          <input
            :class="{ 'tw-border-red-500': errors.last_name }"
            @input="deleteError('last_name')"
            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
            id="last_name"
            maxlength="20"
            placeholder="שם משפחה"
            type="text"
            v-model="auth.last_name"
          />

          <div
            class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
            v-if="errors.last_name"
          >
            {{ errors.last_name[0] }}
          </div>
        </div>

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
            maxlength="50"
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

        <div class="tw-mb-5">
          <label
            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
            for="password"
          >
            סיסמה
          </label>
          <input
            :class="{ 'tw-border-red-500': errors.password }"
            @input="deleteError('password')"
            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
            id="password"
            maxlength="255"
            placeholder="סיסמה"
            type="password"
            v-model="auth.password"
          />

          <div
            class="tw-font-semibold tw-text-red-500 tw-text-xs tw-mt-1"
            v-if="errors.password"
          >
            {{ errors.password[0] }}
          </div>
        </div>

        <div class="tw-mb-5">
          <label
            class="tw-block tw-text-gray-700 tw-text-sm tw-font-bold tw-mb-2"
            for="password_confirmation"
          >
            אישור סיסמה
          </label>
          <input
            class="input transition tw-shadow tw-appearance-none tw-border tw-rounded tw-w-full tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight"
            id="password_confirmation"
            maxlength="255"
            placeholder="סיסמה"
            type="password"
            v-model="auth.password_confirmation"
          />
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
          <div class="tw-mb-5">
            <router-link
              :to="{ name: 'login' }"
              class="link tw-text-sm tw-font-bold"
            >
              יש לך כבר משתמש?
            </router-link>
          </div>

          <button
            class="btn tw-py-2 tw-px-3 tw-bg-primary tw-rounded tw-text-white tw-border tw-border-primary"
            type="submit"
          >
            התחבר
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "register",

  data() {
    return {
      auth: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },

      isLoading: false,

      errors: {}
    };
  },

  methods: {
    register() {
      if (this.isLoading) {
        return;
      }

      this.isLoading = true;

      this.$store
        .dispatch("register", this.auth)
        .then(() => {
          this.isLoading = false;

          this.$toast.success(
            "משתמש נרשם בהצלחה, נא לאמת את המשתמש באמצעות הקישור שנשלח לאימייל."
          );

          this.$router.push({ name: "login" });
        })
        .catch(err => {
          if (err.response.status === 422 && err.response.data.errors) {
            this.errors = err.response.data.errors;
          }
          this.isLoading = false;
        });
    },

    deleteError(property) {
      this.errors[property] = null;
    }
  }
};
</script>
